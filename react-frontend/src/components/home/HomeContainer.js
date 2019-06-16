import React from 'react';
import ScrollDropdown from 'components/common/dropdowns/scroll';
import {getBrand, getModel, getService} from "actions/all/HomeActions";
import {push} from "connected-react-router";
import {connect} from "react-redux";
import {Link} from 'react-router-dom';
import Button from 'react-bootstrap/Button';
import ServiceListContainer from "components/services/ServiceListContainer";

let stoItems = [{id: 1, name: 'Сервис +', geo: 'Ул. Ленина 7/12', telephone: '8977654123'},{id: 2, name: 'АВТО PRO', geo: 'Проспект мира 21', telephone: '8984378287'},{id: 3, name: 'Люкс ремонт', geo: 'ул. Героев - панфиловцев 7', telephone: '8495333384'},];

class HomeContainer extends React.Component {

  state = {
    brandId: null,
    modelId: null,
    serviceId: null,
  };

  componentDidMount() {
    this.props.getBrand('/api/car-brand');
    this.props.getService('/work-type/all');
  }

  render() {

    const {brandItems, modelItems, serviceItems, isFetching} = this.props.home;

    const onBrandClickHandler = (brandId) => {
      this.setState({
        brandId,
        modelId: null,
        serviceId: null,
      });
      this.props.getModel('/api/car-brand/' + brandId);
    };

    const onModelClickHandler = (modelId) => {
      this.setState({
        modelId,
        serviceId: null,
      });
    };

    const onServiceClickHandler = (serviceId) => {
      this.setState({
        serviceId
      });
    };

    return (
      <div>
        <div>
          <div className="header">
            <div className="wrap-header-top">
              <div className="wrap-left">
                <div className="logo"><Link to="/">АВТОГИГАНТ</Link></div>
                <div className="city">город:</div>
                <select className="drop-down-city">
                  <option>Москва &#8744;</option>
                  <option>Рязань</option>
                </select>
                 
              </div>
              <div className="wrap-right">
                <Link to="/login/client">Войти /</Link>
                <Link to="/registry/client">Регистрация</Link>
              </div>
            </div>
            <h1>Выбирай автосервисы по оптимальной цене и качеству</h1>
            <div className="drop-down-filters">
              <div className="d-flex justify-content-start w-100">
                <ScrollDropdown className="brand-car" title="Марка" items={brandItems} onClickHandler={onBrandClickHandler}/>
                <ScrollDropdown className="model-car" title="Модель" items={modelItems} onClickHandler={onModelClickHandler} reset={isFetching}/>
                <ScrollDropdown className="task" title="Услуга" items={serviceItems} onClickHandler={onServiceClickHandler} reset={isFetching}/>
                <Button variant="danger" className="btn-search">Найти цены</Button>
              </div>
            </div>
          </div>

          {/*<div className="d-flex justify-content-start w-100">*/}
            {/*<ScrollDropdown title="Марка" items={brandItems} onClickHandler={onBrandClickHandler}/>*/}
            {/*<ScrollDropdown title="Модель" items={modelItems} onClickHandler={onModelClickHandler} reset={isFetching}/>*/}
            {/*<ScrollDropdown title="Услуга" items={serviceItems} onClickHandler={onServiceClickHandler} reset={isFetching}/>*/}
            {/*<Button variant="danger" className="ml-5">Найти цены</Button>*/}
          {/*</div>*/}
          <ServiceListContainer stoItems={stoItems}/>
        </div>
      </div>
    )
  }
}

const mapStateToProps = store => {
  return {
    home: store.home,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    getBrand: (url) => dispatch(getBrand(url)),
    getModel: (url) => dispatch(getModel(url)),
    getService: (url) => dispatch(getService(url)),
    redirect: () => dispatch(push('/login/client')),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(HomeContainer)

