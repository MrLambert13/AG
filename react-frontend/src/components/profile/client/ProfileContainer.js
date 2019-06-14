import React from 'react';
import {connect} from "react-redux";
import {logout} from "actions/client/UserActions";
import {getProfile, LOCAL_PROFILE_UPDATE} from "actions/client/ProfileActions";
import {push} from "connected-react-router";
import {Table, Button} from 'react-bootstrap';
import ModalEdit from './ModalEdit';
import ModalPassword from './ModalPassword';

class ProfileContainer extends React.Component {

  state = {
    modalEditShow: false,
    modalPasswordShow: false
  };

  componentWillMount() {
    if (!this.props.user.token) {
      this.props.redirect();
      return;
    }

    if (!this.props.profile.success) {
      // Запрашиваем пользовательский профиль
      if (this.props.user.id_user) {
        let data = {
          'token': this.props.user.token,
          'id_user': this.props.user.id_user,
        };

        this.props.getProfile('/profile', data);
      }
    }
  }

  render() {

    const {profile, updateProfileInStorage} = this.props;

    let birthday = new Date(profile.birthday * 1000);
    let createdAt = new Date(profile.created_at * 1000);

    let modalEditClose = () => this.setState({ modalEditShow: false });
    let modalPasswordClose = () => this.setState({ modalPasswordShow: false });

    return (
      <div>
        <h4>
          Добро пожаловать, {this.props.user.username}
          <button className="btn btn-info btn-md" onClick={this.onClickHandler}>Выйти</button>
        </h4>

        <div>
          <Table responsive="sm" striped bordered hover variant="dark">
            <tbody>
            <tr>
              <td>Логин</td>
              <td>{profile.username}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>{profile.email}</td>
            </tr>
            <tr>
              <td>Телеграм</td>
              <td>{profile.telegram}</td>
            </tr>
            <tr>
              <td>Фамилия</td>
              <td>{profile.surname}</td>
            </tr>
            <tr>
              <td>Имя</td>
              <td>{profile.name}</td>
            </tr>
            <tr>
              <td>Отчество</td>
              <td>{profile.middlename}</td>
            </tr>
            <tr>
              <td>Дата рождения</td>
              <td>{birthday.toLocaleString().substr(0, 10)}</td>
            </tr>
            <tr>
              <td>Город</td>
              <td>{profile.city}</td>
            </tr>
            <tr>
              <td>Телефон</td>
              <td>{profile.telephone}</td>
            </tr>
            <tr>
              <td>Зарегистрирован</td>
              <td>{createdAt.toLocaleString()}</td>
            </tr>
            </tbody>
          </Table>
          <div className="d-flex justify-content-around">
            <Button className="btn btn-danger" onClick={() => {this.setState({ modalEditShow: true })}}>Редактировать профиль</Button>
            <Button className="btn btn-danger" onClick={() => {this.setState({ modalPasswordShow: true })}}>Изменить пароль</Button>
          </div>
          <ModalEdit
            show={this.state.modalEditShow}
            onHide={modalEditClose}
          />
          <ModalPassword
            show={this.state.modalPasswordShow}
            onHide={modalPasswordClose}
          />
        </div>
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
    profile: store.profile,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    logout: (url, data) => dispatch(logout(url, data)),
    getProfile: (url, data) => dispatch(getProfile(url, data)),
    redirect: () => dispatch(push('/login/client')),
    updateProfileInStorage: (data) => dispatch({type: LOCAL_PROFILE_UPDATE, payload: data}),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(ProfileContainer)
