import React from 'react';
import {connect} from "react-redux";
import {getCart} from "actions/client/CartActions";
import Spinner from 'react-bootstrap/Spinner';
import {Link} from 'react-router-dom';
import {push} from "connected-react-router";

class CartContainer extends React.Component {

  componentWillMount() {
    if (!this.props.user.token) {
      this.props.redirect();
      return;
    }

    // this.props.getCart('/api/basket', {idUser: this.props.id_user});
    this.props.getCart('/api/basket', {idUser: 1});
  }

  render() {
    const {cart} = this.props;

    return (
      <div>
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
    cart: store.cart,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    getCart: (url, data) => dispatch(getCart(url, data)),
    redirect: () => dispatch(push('/login/client')),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(CartContainer)