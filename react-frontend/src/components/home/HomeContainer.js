import React from 'react';
import ScrollDropdown from 'components/common/dropdowns/scroll';
import {getBrand, getModel, getService} from "actions/all/HomeActions";
import {push} from "connected-react-router";
import {connect} from "react-redux";
import Button from 'react-bootstrap/Button';
import ServiceListContainer from "./ServiceListContainer";

class HomeContainer extends React.Component {

  state = {
    brandId: null,
    modelId: null,
    serviceId: null,
  };

  componentDidMount() {
    this.props.getBrand('/api/car-brand')
  }

  render() {

    const {brandItems, modelItems, serviceItems, isFetching} = this.props.home;

    const onBrandClickHandler = (brandId) => {
      this.setState({
        brandId,
        modelId: null,
        serviceId: null,
      });
      this.props.getModel('/api/car-brand/' + brandId);
    };

    const onModelClickHandler = (modelId) => {
      this.setState({
        modelId,
        serviceId: null,
      });
    };

    const onServiceClickHandler = (serviceId) => {
      this.setState({
        serviceId
      });

      // Получаем список услуг
      this.props.getService('URL');
    };

    return (
      <div className="container">
        <div className="d-flex justify-content-start w-100">
          <ScrollDropdown title="Марка" items={brandItems} onClickHandler={onBrandClickHandler}/>
          <ScrollDropdown title="Модель" items={modelItems} onClickHandler={onModelClickHandler} reset={isFetching}/>
          <ScrollDropdown title="Услуга" items={serviceItems} onClickHandler={onServiceClickHandler} reset={isFetching}/>
          <Button variant="danger" className="ml-5">Найти цены</Button>
        </div>
        <ServiceListContainer/>
      </div>
    )
  }
}

const mapStateToProps = store => {
  return {
    home: store.home,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    getBrand: (url) => dispatch(getBrand(url)),
    getModel: (url) => dispatch(getModel(url)),
    getService: (url) => dispatch(getService(url)),
    redirect: () => dispatch(push('/login/client')),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(HomeContainer)

