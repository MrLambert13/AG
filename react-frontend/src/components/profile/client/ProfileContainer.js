import React from 'react';
import {connect} from "react-redux";
import { logout } from "actions/client/UserActions";
import {push} from "connected-react-router";
// import history from 'store/history';

class ProfileContainer extends React.Component {

  componentWillMount () {
    if (!this.props.user.token) {
      this.props.redirect()
    }
  }

  render () {
    return (
      <div>
        <h4>Добро пожаловать, {this.props.user.username}</h4>
        <button onClick={this.onClickHandler}>Выйти</button>
      </div>
    )
  }

  onClickHandler = (e) => {
    this.props.logout('/logout', {email: this.props.user.payload ? this.props.user.payload.email : null});
    this.props.redirect();
  }
}

const mapStateToProps = store => {
  return {
    user: store.user,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    logout: (url, data) => dispatch(logout(url, data)),
    redirect: () => dispatch(push('/login/client')),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(ProfileContainer)
