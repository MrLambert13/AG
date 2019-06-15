import React from 'react';
import classNames from 'classnames';
import {Formik, Form, Field} from 'formik';
import * as Yup from 'yup';
import FormikInput from 'components/common/inputs/FormikInput'
import {updatePassword} from "actions/client/ProfileActions";
import {connect} from "react-redux";

const validationScheme = Yup.object().shape({
  passwordOld: Yup.string()
    .required('Required'),
  password: Yup.string()
    .matches(/[a-zA-Z]/, 'Password can only contain Latin letters.')
    .min(5, 'Password is too short - should be 5 chars minimum.')
    .required('Required'),
  passwordConfirm: Yup.string()
    .oneOf([Yup.ref('password'), null],"Passwords don't match")
    .required('Password confirm is required')
});

class FormPasswordContainer extends React.Component {

  render() {
    const { updatePassword } = this.props;

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
              id_user: this.props.user.id_user,
              token: this.props.user.token,
              pass_old: values.passwordOld,
              pass_new: values.password,
            };

            updatePassword('/update-password', data);
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
}

const mapStateToProps = store => {
  return {
    user: store.user,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    updatePassword: (url, data) => dispatch(updatePassword(url, data)),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(FormPasswordContainer)