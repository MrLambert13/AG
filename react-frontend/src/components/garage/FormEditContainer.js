import React from 'react';
import {Formik, Form} from 'formik';
import * as Yup from 'yup';
import FormikInput from 'components/common/inputs/FormikInput'
import {updateTS} from "actions/client/GarageActions";
import {connect} from "react-redux";

const validationScheme = Yup.object().shape({
  reg_number: Yup.string()
    .required('Required'),
  power: Yup.string()
    .required('Required'),
  vin: Yup.string()
    .length(17, 'VIN - 17 значный номер'),
  mileage: Yup.number()
    .required('Required'),
});

class FormEditContainer extends React.Component {

  render() {
    const {updateTS, vehicle, onHide} = this.props;

    return (
      <div>
        <Formik
          validateOnChange
          initialValues={{
            ...vehicle,
          }}
          validationSchema={validationScheme}

          onSubmit={values => {

            let data = {
              reg_number: values.reg_number,
              power: values.power,
              vin: values.vin,
              mileage: values.mileage
            };

            // Отправляем отредактированные данные
            updateTS('/api/vehicle/' + vehicle.id, data);
            // Закрываем форму
            onHide();
          }}
        >
          {({errors, touched}) => (

            <Form className="needs-validation" noValidate>
              <div className="form-row">
                <FormikInput name="reg_number" label="Регистрационный номер" error={errors.reg_number} touched={touched.reg_number}/>
                <FormikInput name="vin" label="Вин код" error={errors.vin} touched={touched.vin}/>
                <FormikInput name="power" label="Мощность" error={errors.power} touched={touched.power}/>
                <FormikInput name="mileage" label="Пробег" error={errors.mileage} touched={touched.mileage}/>
              </div>
              <button type="submit" className="btn btn-primary">Отправить</button>
            </Form>
          )}
        </Formik>
      </div>
    )
  }
}

const mapStateToProps = store => {
  return {
    garage: store.garage,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    updateTS: (url, data) => dispatch(updateTS(url, data)),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(FormEditContainer)