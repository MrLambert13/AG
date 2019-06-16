import React from 'react';
import {Formik, Form, Field} from 'formik';
import * as Yup from 'yup';
import FormikInput from 'components/common/inputs/FormikInput'
import ScrollDropdown from 'components/common/dropdowns/scroll';
import {setTS} from "actions/client/GarageActions";
import {getBrand, getModel} from "actions/all/HomeActions";
import {logout} from "actions/client/UserActions";
import {connect} from "react-redux";
import {push} from "connected-react-router";

const validationScheme = Yup.object().shape({
  reg_number: Yup.string()
    .required('Required'),
  power: Yup.string()
    .required('Required'),
  vin: Yup.string()
    .length(17, 'VIN - 17 значный номер')
    .required('Required'),
  mileage: Yup.number()
    .typeError('Пробег должен быть числом')
    .required('Required'),
  rel_year: Yup.number()
    .typeError('Год выпуска должен быть числом')
    .required('Required'),
});

class FormAddContainer extends React.Component {

  state = {
    brandId: null,
    modelId: null,
    motorId: null,
    modelIdError: '',
  };

  componentDidMount() {
    if (!this.props.home.brandItems) {
      this.props.getBrand('/api/car-brand')
    }
  }

  render() {
    const {brandItems, modelItems, motorItems, isFetching} = this.props.home;
    const {setTS, onHide} = this.props;

    const onBrandClickHandler = (brandId) => {
      this.setState({
        brandId,
        modelId: null,
      });
      this.props.getModel('/api/car-brand/' + brandId);
    };

    const onModelClickHandler = (modelId) => {
      this.setState({
        modelId,
        modelIdError: ''
      });
    };

    return (
      <div>
        <Formik
          validateOnChange
          initialValues={{
            reg_number: '',
            power: '',
            vin: '',
            mileage: '',
            rel_year: '',
          }}

          validationSchema={validationScheme}

          onSubmit={values => {

            let data = {
              created_by: this.props.user.id_user,
              updated_by: this.props.user.id_user,
              id_car_model: this.state.modelId,
              id_motor: 1,
              reg_number: values.reg_number,
              power: values.power,
              vin: values.vin,
              mileage: values.mileage,
              rel_year: values.rel_year,
              id_transmission: 1,
            };

            if (!this.state.modelId) {
              this.setState({
                modelIdError: 'Вы не выбрали марку автомобиля'
              });
              return;
            } else {
              this.setState({
                modelIdError: ''
              });
            }
            // Отправляем отредактированные данные
            setTS('/api/vehicle', data);
            // Закрываем форму
            onHide();
          }}
        >
          {({errors, touched}) => (
            <div>
              <div className="form-row">
                <ScrollDropdown className="brand-car" title="Марка" items={brandItems} onClickHandler={onBrandClickHandler}/>
                <ScrollDropdown className="model-car" title="Модель" items={modelItems} onClickHandler={onModelClickHandler} reset={isFetching}/>
                {/*<ScrollDropdown className="motor-car" title="Движок" items={motorItems} onClickHandler={onMotorClickHandler}/>*/}
              </div>
              <div className="form-row">
                <span className="text-danger">{this.state.modelIdError}</span>
              </div>
              <Form className="needs-validation" noValidate>
                <div className="form-row">
                  <FormikInput name="reg_number" label="Рег. номер" error={errors.reg_number} touched={touched.reg_number}/>
                  <FormikInput name="vin" label="Вин код" error={errors.vin} touched={touched.vin}/>
                  <FormikInput name="power" label="Мощность" error={errors.power} touched={touched.power}/>
                  <FormikInput name="mileage" label="Пробег" error={errors.mileage} touched={touched.mileage}/>
                  <FormikInput name="rel_year" label="Год выпуска" error={errors.rel_year} touched={touched.rel_year}/>
                </div>
                <button type="submit" className="btn btn-primary">Отправить</button>
              </Form>
            </div>

          )}
        </Formik>
      </div>
    )
  }
}

const mapStateToProps = store => {
  return {
    garage: store.garage,
    home: store.home,
    user: store.user,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    getBrand: (url) => dispatch(getBrand(url)),
    getModel: (url) => dispatch(getModel(url)),
    setTS: (url, data) => dispatch(setTS(url, data)),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(FormAddContainer)