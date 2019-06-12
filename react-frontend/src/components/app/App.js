import React from 'react';
import { Router, Route, Switch } from 'react-router-dom';
// import history from 'store/history';

import './App.scss';

import Home from 'routes/home';

import LoginClient from 'routes/login/client';
import LoginOwner from 'routes/login/owner';

import RegistryClient from 'routes/registry/client';
import RegistryOwner from 'routes/registry/owner';

import ClientCabinet from 'routes/client/cabinet';
import Garage from 'routes/client/cabinet/garage';
import ClientRequest from 'routes/client/cabinet/request';
import ClientRequestView from 'routes/client/cabinet/request/view';
import ClientProfile from 'routes/client/cabinet/profile';

import OwnerCabinet from 'routes/owner/cabinet';
import Service from 'routes/owner/cabinet/service';
import OwnerRequest from 'routes/owner/cabinet/request';
import OwnerRequestView from 'routes/owner/cabinet/request/view';
import OwnerProfile from 'routes/owner/cabinet/profile';

class App extends React.Component {
  render() {
    return (
      <div className="containers">
        <Switch>
          <Route exact path="/" component={Home} />

          <Route path="/login/client" component={LoginClient} />
          <Route path="/login/owner" component={LoginOwner} />

          <Route path="/registry/client" component={RegistryClient} />
          <Route path="/registry/owner" component={RegistryOwner} />

          <Route exact path="/client/cabinet" component={ClientCabinet} />
          <Route path="/client/cabinet/garage" component={Garage} />
          <Route exact path="/client/cabinet/request" component={ClientRequest} />
          <Route path="/client/cabinet/request/view/:id" component={ClientRequestView} />
          <Route path="/client/cabinet/profile" component={ClientProfile} />

          <Route exact path="/owner/cabinet" component={OwnerCabinet} />
          <Route path="/owner/cabinet/service" component={Service} />
          <Route exact path="/owner/cabinet/request" component={OwnerRequest} />
          <Route path="/owner/cabinet/request/view/:id" component={OwnerRequestView} />
          <Route path="/owner/cabinet/profile" component={OwnerProfile} />

        </Switch>
      </div>
    )
  }
}

export default App