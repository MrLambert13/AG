import React from 'react';
import {Formik, Form, Field} from 'formik';
import * as Yup from 'yup';
import FormikInput from 'components/common/inputs/FormikInput'

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

export default class FormEdit extends React.Component {

  render() {
    const {url, sendMethod, profile} = this.props;

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
            let data = {
              token: '',
              username: values.username,
              email: values.email,
              telegram: values.telegram,
              surname: values.surname,
              middlename: values.middlename,
              name: values.name,
              birthday: values.birthday,
              city: values.city,
              telephone: values.telephone,
            };

            // Отправляем отредактированные данные
            sendMethod(url, data);
          }}
        >
          {({errors, touched}) => (

            <Form className="needs-validation" noValidate>
              <div className="form-row">
                <FormikInput name="username" label="Логин" error={errors.username} touched={touched.username}/>
                <FormikInput name="email" label="Email" error={errors.email} touched={touched.email}/>
                <FormikInput name="telegram" label="Телеграм ник" prepend="@" error={errors.telegram} touched={touched.telegram}/>
              </div>
              <div className="form-row">
                <FormikInput name="surname" label="Фамилия" error={errors.surname} touched={touched.surname}/>
                <FormikInput name="name" label="Имя" error={errors.name} touched={touched.name}/>
                <FormikInput name="middlename" label="Отчество" error={errors.middlename} touched={touched.middlename}/>
              </div>
              <div className="form-row">
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