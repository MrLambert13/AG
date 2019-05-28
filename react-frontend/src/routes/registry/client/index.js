import React from 'react';
import RegistryContainer from 'components/registry';

export default class Registry extends React.Component {
  render() {
    return (
      <div>
        <h1>Client Registry page</h1>
        <RegistryContainer/>
      </div>
    )
  }
}
