import React from 'react';
import Main from 'components/common/layouts/client/main';
import OrderContainer from 'components/order/client';

export default class Request extends React.Component {
  render() {
    return (
      <Main>
        <OrderContainer/>
      </Main>
    )
  }
}
