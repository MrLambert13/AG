import React from 'react';
import ScrollDropdown from 'components/common/dropdowns/scroll/index';
import {getBrand, getModel, getService} from "actions/all/HomeActions";
import {push} from "connected-react-router";
import {connect} from "react-redux";
import {Link} from 'react-router-dom';
import Button from 'react-bootstrap/Button';
import ServiceList from "components/services/ServiceList";
import AlertDismissible from 'components/common/alerts/AlertDismissible';

let stoItems = [{id: 1, name: 'Сервис +', geo: 'Ул. Ленина 7/12', telephone: '8977654123'},{id: 2, name: 'АВТО PRO', geo: 'Проспект мира 21', telephone: '8984378287'},{id: 3, name: 'Люкс ремонт', geo: 'ул. Героев - панфиловцев 7', telephone: '8495333384'},];

class CabinetContainer extends React.Component {

  state = {
    vehicleId: null,
    serviceId: null,
    stoId: null,
    showResults: false,
    showAlert: false
  };

  componentDidMount() {
    this.props.getService('/work-type/all');

    // Получаю список СТО, пока нет АПИ - хардкод
  }

  render() {

    let filteredItems = this.props.garage.TS.filter( (item) => (+item.created_by === this.props.user.id_user));

    filteredItems.map((item) => {
      item['name'] = item.car_model.name;
    });

    const onVehicleClickHandler = (vehicleId) => {
      this.setState({
        vehicleId,
        showResults: false,

      });
    };

    const onServiceClickHandler = (serviceId) => {
      this.setState({
        serviceId,
        showResults: false
      });
    };

    const onBtnChooseClickHandler = (stoId) => {
      this.setState({
        stoId,
        showResults: false,
        showAlert: true
      })
      // Добавляю элемент в корзину

    };

    const onBtnSearchClickHandler = () => {
      this.setState({
        showResults: true
      })
    };

    const onBtnCloseAlertHandler = () => {
      this.setState({
        showAlert: false
      })
    };

    return (
      <div>
        <div>
          <div className="header header-min" style={{height: 100, width: '100%'}}>
            <div className="drop-down-filters">
              <div className="d-flex justify-content-start w-100">
                <ScrollDropdown className="brand-car" title="Авто" items={filteredItems} onClickHandler={onVehicleClickHandler}/>
                <ScrollDropdown className="task" title="Услуга" items={this.props.serviceItems} onClickHandler={onServiceClickHandler}/>
                <Button variant="danger" className="btn-search" onClick={onBtnSearchClickHandler}>Найти цены</Button>
              </div>
            </div>
          </div>
          <AlertDismissible
            show={this.state.showAlert}
            onHide={onBtnCloseAlertHandler}
            headerText="Сто выбран"
            bodyText="В корзине вы можете сформировать заказ"
          />
          { this.state.showResults ? <ServiceList items={stoItems} onChoose={onBtnChooseClickHandler}/> : null }
        </div>
      </div>
    )
  }
}

const mapStateToProps = store => {
  return {
    user: store.user,
    garage: store.garage,
    serviceItems: store.home.serviceItems,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    getService: (url) => dispatch(getService(url)),
    redirect: () => dispatch(push('/login/client')),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(CabinetContainer)

