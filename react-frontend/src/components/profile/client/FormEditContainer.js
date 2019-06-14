import React from 'react';
import {Formik, Form, Field} from 'formik';
import * as Yup from 'yup';
import FormikInput from 'components/common/inputs/FormikInput'
import {LOCAL_PROFILE_UPDATE, updateProfile} from "actions/client/ProfileActions";
import {logout} from "actions/client/UserActions";
import {connect} from "react-redux";
import {push} from "connected-react-router";

const validationScheme = Yup.object().shape({
  username: Yup.string()
    .min(4, 'Too Short!')
    .max(25, 'Too Long!')
    .required('Required'),
  email: Yup.string()
    .email('Invalid email')
    .required('Required'),
  telegram: Yup.string()
    .matches(/[a-zA-Z0-9]/, 'Only contain Latin letters.')
    .required('Required'),
  surname: Yup.string()
    .required('Required'),
  name: Yup.string()
    .required('Required'),
  birthday: Yup.string()
    .required('Required'),
  city: Yup.string()
    .required('Required'),
  telephone: Yup.string()
    .required('Required'),
});

class FormEditContainer extends React.Component {

  render() {
    const {updateProfile, user, profile, onHide} = this.props;

    let birthday = new Date(profile.birthday * 1000);

    return (
      <div>
        <Formik
          validateOnChange
          initialValues={{
            ...profile,
            birthday: birthday.toISOString().substr(0, 10)
          }}
          validationSchema={validationScheme}

          onSubmit={values => {
            let birthday = values.birthday ? new Date(values.birthday) : profile.birthday;

            if (birthday) {
              birthday = birthday.getTime() / 1000;
            }

            let data = {
              id_user: user.id_user,
              token: user.token,
              status: profile.status,
              id_user_type: profile.user_type,
              username: values.username,
              telegram_name: values.telegram,
              telegram: values.telegram,
              surname: values.surname,
              middlename: values.middlename,
              name: values.name,
              birthday,
              id_city: profile.id_city,
              telephone: values.telephone,
            };

            // Отправляем отредактированные данные
            updateProfile('/update-info', data);
            // Закрываем форму
            onHide();
          }}
        >
          {({errors, touched}) => (

            <Form className="needs-validation" noValidate>
              <div className="form-row">
                <FormikInput name="surname" label="Фамилия" error={errors.surname} touched={touched.surname}/>
                <FormikInput name="name" label="Имя" error={errors.name} touched={touched.name}/>
                <FormikInput name="middlename" label="Отчество" error={errors.middlename} touched={touched.middlename}/>
              </div>
              <div className="form-row">
                <FormikInput name="username" label="Логин" error={errors.username} touched={touched.username}/>
                {/*<FormikInput name="email" label="Email" error={errors.email} touched={touched.email}/>*/}
                <FormikInput name="telegram" label="Телеграм ник" prepend="@" error={errors.telegram} touched={touched.telegram}/>
                <FormikInput name="birthday" label="Дата рождения" error={errors.birthday} touched={touched.birthday} type="date"/>
              </div>

              <button type="submit" className="btn btn-primary">Отправить</button>
            </Form>
          )}
        </Formik>
      </div>
    )
  }
};

const mapStateToProps = store => {
  return {
    user: store.user,
    profile: store.profile,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    updateProfile: (url, data) => dispatch(updateProfile(url, data)),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(FormEditContainer)