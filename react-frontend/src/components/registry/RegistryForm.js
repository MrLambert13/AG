import React from 'react';
import classNames from 'classnames';
import {Formik, Form, Field} from 'formik';
import * as Yup from 'yup';

const SignupSchema = Yup.object().shape({
  username: Yup.string()
    .min(4, 'Too Short!')
    .max(25, 'Too Long!')
    .required('Required'),
  email: Yup.string()
    .email('Invalid email')
    .required('Required'),
  password: Yup.string()
    .matches(/[a-zA-Z]/, 'Password can only contain Latin letters.')
    .min(8, 'Password is too short - should be 8 chars minimum.')
    .required('No password provided.'),
  passwordConfirm: Yup.string()
    .oneOf([Yup.ref('password'), null],"Passwords don't match")
    .required('Password confirm is required')
});

class RegistryForm extends React.Component {

  render() {
    const { url, sendMethod } = this.props;

    return (
      <div>
        <Formik
          initialValues={{
            username: '',
            email: '',
            password: '',
            passwordConfirm: ''
          }}
          validationSchema={SignupSchema}

          onSubmit={values => {
            let data = {
              username: values.username,
              email: values.email,
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
                    {/* <span>Username</span> */}
                    <Field
                      name="username"
                      className={
                        classNames(
                          'form-control',
                          'mt-1',
                          touched.username ? (errors.username && touched.username ? 'is-invalid' : 'is-valid') : null
                        )}
                      id="inputUserName"
                      placeholder="Название компании"
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
                    {/* <span>Email</span> */}
                    <Field
                      name="email"
                      className={
                        classNames(
                          'form-control',
                          'mt-1',
                          touched.email ? (errors.email && touched.email ? 'is-invalid' : 'is-valid') : null
                        )}
                      id="inputEmail"
                      placeholder="Адрес"
                    />
                    {errors.email && touched.email ? (
                      <div className="feedback-error">{errors.email}</div>
                    ) : null}
                  </label>
                </div>
              </div>

              <div className="form-row">
                <div className="form-group">
                  <label>
                    {/* <span>Password</span> */}
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
                      placeholder="Телефон"
                    />
                    {errors.password && touched.password ? (
                      <div className="feedback-error">{errors.password}</div>
                    ) : null}
                  </label>
                </div>
              </div>

              <div className="form-row">
                <div className="form-group">
                  <label>
                    {/* <span>Password confirm</span> */}
                    <Field
                      name="passwordConfirm"
                      type="password"
                      className={
                        classNames(
                          'form-control',
                          'mt-1',
                          touched.passwordConfirm ? (errors.passwordConfirm && touched.passwordConfirm ? 'is-invalid' : 'is-valid') : null
                        )}
                      id="inputPasswordConfirm"
                      placeholder="Ваше имя"
                    />
                    {errors.passwordConfirm && touched.passwordConfirm ? (
                      <div className="feedback-error">{errors.passwordConfirm}</div>
                    ) : null}
                  </label>
                </div>
              </div>

              <button type="submit" className="btn-registry">Далее</button>         
                            

            </Form>
            
          )}
        </Formik>
        
      </div>
    )
  }
};

export default RegistryForm;