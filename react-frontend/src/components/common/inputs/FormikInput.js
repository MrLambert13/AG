import React from 'react'
import {Formik, Form, Field} from 'formik';
import classNames from "classnames";

const FormikInput = (props) => {

  const {name, label, placeholder, prepend, error, touched} = props;

  const type = props.type ? props.type : "text";

  return (
    <div className="form-group col-md">
      <label>
        <span>{label}</span>
        <div className="input-group flex-nowrap">
          {prepend && <div className="input-group-prepend"><span className="input-group-text">{prepend}</span></div>}
          <Field
            name={name}
            type={type}
            className={
              classNames(
                'form-control',
                'mt-1',
                touched ? (error && touched ? 'is-invalid' : 'is-valid') : null
              )}
            placeholder={placeholder}
          />
        </div>
        {error && touched ? (
          <div className="feedback-error">{error}</div>
        ) : null}
      </label>
    </div>
  )
};

export default FormikInput