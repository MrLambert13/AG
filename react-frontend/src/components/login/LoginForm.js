import React from 'react';
import classNames from 'classnames';
import {Formik, Form, Field} from 'formik';
import * as Yup from 'yup';

const LoginSchema = Yup.object().shape({
  username: Yup.string()
    .required('Required'),
  password: Yup.string()
    .required('Required'),
});

class LoginForm extends React.Component {

  render() {
    const { url, sendMethod } = this.props;

    return (
      <div>
        <Formik
          initialValues={{
            username: '',
            password: '',
          }}
          validationSchema={LoginSchema}

          onSubmit={values => {
            let data = {
              username: values.username,
              password: values.password
            };

            sendMethod(url, data);
          }}
        >
          {({errors, touched}) => (

            <Form className="needs-validation" noValidate>
              <div className="form-row">
                <div className="form-group">
                  <label>
                    <span>Username</span>
                    <Field
                      name="username"
                      className={
                        classNames(
                          'form-control',
                          'mt-1',
                          touched.username ? (errors.username && touched.username ? 'is-invalid' : 'is-valid') : null
                        )}
                      id="inputUserName"
                      placeholder="Username"
                    />
                    {errors.username && touched.username ? (
                      <div className="feedback-error">{errors.username}</div>
                    ) : null}
                  </label>
                </div>
              </div>

              <div className="form-row">
                <div className="form-group">
                  <label>
                    <span>Password</span>
                    <Field
                      name="password"
                      type="password"
                      className={
                        classNames(
                          'form-control',
                          'mt-1',
                          touched.password ? (errors.password && touched.password ? 'is-invalid' : 'is-valid') : null
                        )}
                      id="inputPassword"
                      placeholder="Password"
                    />
                    {errors.password && touched.password ? (
                      <div className="feedback-error">{errors.password}</div>
                    ) : null}
                  </label>
                </div>
              </div>

              <button type="submit" className="btn btn-primary">Войти</button>

            </Form>
          )}
        </Formik>
      </div>
    )
  }
};

export default LoginForm;