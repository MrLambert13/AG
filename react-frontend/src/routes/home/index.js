import React from 'react';
import {Link} from 'react-router-dom';
import AutocompleteInput from 'components/common/inputs/autocomplete';
import HomeContainer from 'components/home';

export default class Home extends React.Component {
  render() {
    return (
      <div>
        <div className="jumbotron">
          <h1 className="display-4">Добро пожаловать в Автогигант!</h1>
          <hr/>
          <AutocompleteInput items={[{'id': 1, 'name': 'asdsdbs'}, {'id': 2, 'name': 'asdsdbs3434'}, {'id': 3, 'name': 'csdsdbs'},]}/>
          <hr/>
          <HomeContainer/>
          <p className="lead">Это простой пример блока с компонентом в стиле jumbotron для привлечения дополнительного
            внимания к содержанию или информации.</p>
          <hr className="my-4"/>
          <p>Использются служебные классы для типографики и расстояния содержимого в контейнере большего размера.</p>
          <div className="container">
            <div className="row">
              <div className="col-sm">
                <div className="lead">
                  <Link to="/login/client" className="btn btn-primary btn-lg">Войти как пользователь</Link>
                  <div><Link to="/registry/client" className="text-dark">Зарегистрироваться</Link></div>
                </div>
              </div>
              <div className="col-sm">
                <div className="lead">
                  <Link to="/login/owner" className="btn btn-primary btn-lg">Войти как владелец СТО</Link>
                  <div><Link to="/registry/owner" className="text-dark">Зарегистрироваться</Link></div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    )
  }
}
