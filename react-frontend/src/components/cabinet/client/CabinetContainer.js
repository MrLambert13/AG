import React from 'react';
import ScrollDropdown from 'components/common/dropdowns/scroll/index';
import {getService} from "actions/all/HomeActions";
import {push} from "connected-react-router";
import {connect} from "react-redux";
import {Link} from 'react-router-dom';
import Button from 'react-bootstrap/Button';
import ServiceList from "components/services/ServiceList";
import AlertDismissible from 'components/common/alerts/AlertDismissible';
import {getSto} from "actions/all/HomeActions";
import {setCart} from "actions/client/CartActions";

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
    this.props.getSto('/api/sto');
  }

  render() {

    let stoItems = [];
    if (this.props.home.stoItems) {
      stoItems = this.props.home.stoItems.payload;
    }

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
      });

      let data = {
        id_work_type: this.state.serviceId,
        id_work_category: 4,
        created_by: this.props.user.id_user,
        id_vehicle: this.state.vehicleId,
        cost_service: 3800,
        id_sto: stoId,
        create_at: Math.floor(Date.now() / 1000),
      };

      this.props.setCart('/api/basket', data)
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
    home: store.home,
    garage: store.garage,
    serviceItems: store.home.serviceItems,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    getService: (url) => dispatch(getService(url)),
    setCart: (url, data) => dispatch(setCart(url, data)),
    redirect: () => dispatch(push('/login/client')),
    getSto: (url) => dispatch(getSto(url)),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(CabinetContainer)

