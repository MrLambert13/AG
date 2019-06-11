import React from 'react';
import GarageContainer  from 'components/garage';
import Main from 'components/common/layouts/client/main';

export default class Garage extends React.Component {
  render() {
    return (
      <Main>
        <h1>Garage page</h1>
        <GarageContainer/>
      </Main>
    )
  }
}
