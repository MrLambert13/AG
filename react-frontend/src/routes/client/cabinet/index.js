import React from 'react';
import Main from 'components/common/layouts/client/main';
import CabinetContainer from 'components/cabinet/client'

export default class Cabinet extends React.Component {
  render() {
    return (
      <Main>
        <CabinetContainer/>
      </Main>
    )
  }
}
