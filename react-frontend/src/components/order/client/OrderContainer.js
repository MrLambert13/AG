import React from 'react';
import {connect} from 'react-redux';
import { getOrder } from 'actions/client/OrderActions'
import OrderItemsCreate from "./OrderItemsCreate";
import OrderItemsInWork from "./OrderItemsInWork";
import OrderItemsComplete from "./OrderItemsComplete";
import {filterItemsWithField} from "utils/arrayHelper";

const STATUS_ORDER_CREATE = 1;
const STATUS_ORDER_IN_WORK = 2;
const STATUS_ORDER_STOP = 3;
const STATUS_ORDER_COMPLETE = 4;

class OrderContainer extends React.Component {

  componentDidMount() {
    // Тут получаем список текущих заказов
    this.props.getOrder('/order/index', {idUser: this.props.user.id_user});
  }

  render() {

    const { order } = this.props;

    const orderItems = order.orderItems.payload;

    if (!orderItems) {
      return null;
    }

    let orderItemsCreate = [];
    let orderItemsInWork = [];
    let orderItemsComplete = [];

    if (orderItems.length) {
      orderItemsCreate = filterItemsWithField('id_request_status', STATUS_ORDER_CREATE, orderItems);
      orderItemsInWork = filterItemsWithField('id_request_status', STATUS_ORDER_IN_WORK, orderItems);
      orderItemsComplete = filterItemsWithField('id_request_status', STATUS_ORDER_COMPLETE, orderItems);
    }

    return (
      <div className="app">
        <h2>СПИСОК ЗАКАЗОВ</h2>
        {orderItemsCreate.length ? <OrderItemsCreate items={orderItemsCreate}/> : null}
        {orderItemsInWork.length ? <OrderItemsInWork items={orderItemsInWork}/> : null}
        {orderItemsComplete.length ? <OrderItemsComplete items={orderItemsComplete}/> : null}
      </div>
    )
  }
}


const mapStateToProps = store => {
  return {
    order: store.order,
    user: store.user,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    getOrder: (url, data) => dispatch(getOrder(url, data)),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(OrderContainer)
