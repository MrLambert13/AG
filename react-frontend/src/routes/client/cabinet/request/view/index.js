import React from 'react';

export default class RequestView extends React.Component {
  render() {
    return (
      <div>
        <h1>Request View page</h1>
        <p>Request Id is {this.props.match.params.id}</p>
      </div>
    )
  }
}
