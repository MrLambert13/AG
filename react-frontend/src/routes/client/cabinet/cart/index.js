import React from 'react';
import CartContainer  from 'components/cart';
import Main from 'components/common/layouts/client/main';

export default class Profile extends React.Component {
  render() {
    return (
      <Main>
        <h1>КОРЗИНА</h1>
        <CartContainer/>
      </Main>
    )
  }
}
