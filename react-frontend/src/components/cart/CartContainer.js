import React from 'react';
import {connect} from "react-redux";
import {getCart} from "actions/client/CartActions";
import Spinner from 'react-bootstrap/Spinner';
import {Link} from 'react-router-dom';
import {push} from "connected-react-router";
import {getService, getSto} from "actions/all/HomeActions";
import {getTS} from "actions/client/GarageActions";
import {deleteCart} from "actions/client/CartActions";
import {setOrder} from "actions/client/OrderActions";
import {findItemWithField, filterItemsWithField} from "utils/arrayHelper";
import AlertDismissible from 'components/common/alerts/AlertDismissible';

class CartContainer extends React.Component {

  state = {
    showAlert: false,
    showItems: true,
    basketId: null
  };

  componentDidMount() {
    if (!this.props.user.token) {
      this.props.redirect();
      return;
  }

    this.props.getCart('/api/basket');
    this.props.getService('/work-type/all');
    this.props.getTS('/api/vehicle');
    this.props.getSto('/api/sto');
  }

  onBtnClickHandler = (e) => {
    const cartItems = filterItemsWithField('created_by', this.props.user.id_user, this.props.cart.cartItems);
    //Формируем заказ

    //Отправвляю запросы на создание заказов
    // В пропсах жду что такой то элемент корзины стал заказом и следовательно его можно удалить
    cartItems.map((item) => {
      this.props.setOrder('/order/create', {
        idUser: this.props.user.id_user,
        idVehicle: item.id_vehicle,
        idCity: 1,
        idCart: item.id
      });
    });

    this.setState({
      showAlert: true
    })
  };

  static getDerivedStateFromProps(nextProps, prevState){

    if (nextProps.order.basketId) {
      if(nextProps.order.basketId!==prevState.basketId){
        // Удаляю корзину с данным ID
        nextProps.deleteCart('/api/basket', nextProps.order.basketId);
        return { basketId: nextProps.order.basketId};
      }

      if (nextProps.cart.deleteSuccess) {
        // Диспатчу экшн, чтобы сбросить basketId
        nextProps.restBasketId();
      }

    }

    return null;
  }

  render() {
    const {cart, garage, home, user} = this.props;
    const stoItems = home.stoItems.payload;
    const cartItems = filterItemsWithField('created_by', user.id_user, cart.cartItems);

    if (!stoItems) {
      return null;
    }

    let cartItemsTemplate = null;

    const onBtnCloseAlertHandler = () => {
      this.setState({
        showAlert: false
      })
    };

    const onBtnDeleteHandler = (e) => {
      const key = +e.target.getAttribute('data-key');
      this.props.deleteCart('/api/basket', key);
    };

    if (garage.TS.length && home.serviceItems.length && stoItems.length) {
      cartItemsTemplate = cartItems.map((item, index) => {
        let vehicle = findItemWithField('id', item.id_vehicle, garage.TS);
        let service = findItemWithField('id', item.id_work_type, home.serviceItems);
        let sto = findItemWithField('id', item.id_sto, stoItems);
        return (
          <tr key={item.id}>
            <th scope="row">{index + 1}</th>
            <td>{vehicle.car_model.name}</td>
            <td>{service.name}</td>
            <td>{sto.info.name}</td>
            <td>{item.cost_service}</td>
            <td><button type="button" className="close" data-key={item.id} onClick={onBtnDeleteHandler}>&times;</button></td>
          </tr>
        )
      });
    }

    return (
      <div>
        <table className="table table-hover">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Автомобиль</th>
            <th scope="col">Работа</th>
            <th scope="col">Исполнитель</th>
            <th scope="col">Цена</th>
          </tr>
          </thead>
          <tbody>
          {cartItemsTemplate}
          </tbody>
        </table>
        {
          cartItems.length
          ? <button className="btn btn-outline-danger" onClick={this.onBtnClickHandler}>Сформировать заказ</button>
          : !cart.isFetching && <p>Корзина пуста, добавьте заказы в <Link to="/client/cabinet">личном кабинете</Link> </p>
        }

        <AlertDismissible
          show={this.state.showAlert}
          onHide={onBtnCloseAlertHandler}
          headerText="Заказ сформирован"
          bodyText="Вы можете увидеть ваши заказы на странице заказов"
        />
        <div className="wrap-for-center">
          {cart.isFetching && <Spinner as="span" animation="border" role="status" size="sm"/>}
        </div>
      </div>
    )
  }
}

const mapStateToProps = store => {
  return {
    user: store.user,
    home: store.home,
    cart: store.cart,
    garage: store.garage,
    order: store.order,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    getCart: (url, data) => dispatch(getCart(url, data)),
    deleteCart: (url, id) => dispatch(deleteCart(url, id)),
    setOrder: (url, data) => dispatch(setOrder(url, data)),
    redirect: () => dispatch(push('/login/client')),
    getService: (url) => dispatch(getService(url)),
    getSto: (url) => dispatch(getSto(url)),
    getTS: url => dispatch(getTS(url)),
    restBasketId: () => dispatch({
      type: 'RESET_CART_ID',
    })
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(CartContainer)