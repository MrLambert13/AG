import React from 'react';
import classNames from 'classnames';
import {Formik, Form, Field} from 'formik';
import * as Yup from 'yup';
import FormikInput from 'components/common/inputs/FormikInput'

const validationScheme = Yup.object().shape({
  passwordOld: Yup.string()
    .required('Required'),
  password: Yup.string()
    .matches(/[a-zA-Z]/, 'Password can only contain Latin letters.')
    .min(8, 'Password is too short - should be 8 chars minimum.')
    .required('Required'),
  passwordConfirm: Yup.string()
    .oneOf([Yup.ref('password'), null],"Passwords don't match")
    .required('Password confirm is required')
});

export default class FormPassword extends React.Component {

  render() {
    const { url, sendMethod } = this.props;

    return (
      <div>
        <Formik
          initialValues={{
            passwordOld: '',
            password: '',
            passwordConfirm: ''
          }}
          validationSchema={validationScheme}

          onSubmit={values => {
            let data = {
              passwordOld: values.passwordOld,
              password: values.password,
              passwordConfirm: values.passwordConfirm,
            };

            sendMethod(url, data);
          }}
        >
          {({errors, touched}) => (
            <Form className="needs-validation" noValidate>

              <div className="form-row">
                <FormikInput name="passwordOld" label="Старый пароль" error={errors.passwordOld} touched={touched.passwordOld} type="password"/>
              </div>

              <div className="form-row">
                <FormikInput name="password" label="Новый пароль" error={errors.password} touched={touched.password} type="password"/>
              </div>

              <div className="form-row">
                <FormikInput name="passwordConfirm" label="Подтвердите пароль" error={errors.passwordConfirm} touched={touched.passwordConfirm} type="password"/>
              </div>

              <button type="submit" className="btn btn-primary">Подтвердить</button>

            </Form>
          )}
        </Formik>
      </div>
    )
  }
};
