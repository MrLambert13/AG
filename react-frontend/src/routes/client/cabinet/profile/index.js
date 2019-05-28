import React from 'react';
import ProfileContainer  from 'components/profile/client'

export default class Profile extends React.Component {
  render() {
    return (
      <div>
        <h1>ProfileClient page</h1>
        <ProfileContainer/>
      </div>
    )
  }
}
