import React from 'react';
import ProfileContainer  from 'components/profile/client';
import Main from 'components/common/layouts/client/main';

export default class Profile extends React.Component {
  render() {
    return (
      <Main>
        <h1>ProfileClient page</h1>
        <ProfileContainer/>
      </Main>
    )
  }
}
