import React, { useState, useEffect } from "react";
import axios from "axios";
import { FaCheckCircle, FaTrash, FaPen } from "react-icons/fa";
import "./estilo.css";

function App() {
  const [lista, setLista] = useState([]);
  const [nombre, setNombre] = useState("");
  const [precio, setPrecio] = useState("");
  const [id, setId] = useState("");
  const [bandera, setBandera] = useState(true);

  useEffect(() => {
    getProductos();
  }, []);

  const getProductos = async () => {
    const res = await axios.get("http://localhost/apirest2/");
    setLista(res.data);
  };

  const addProducto = async () => {
    const obj = { nombre, precio };
    const res = await axios.post("http://localhost/apirest2/", obj);
    getProductos();
    console.log(res);
  };

  const updateProducto = async () => {
    const obj={id,nombre, precio}
   const res= await axios.put('http://localhost/apirest2/',obj)
   getProductos();
  };

  const addUpdate = (e) => {
    e.preventDefault();
    bandera ? addProducto() : updateProducto();
    limpiarEstado();
  };

  const deleteProducto = async (id) => {
    if (window.confirm("¿Quieres eliminar producto: ?")) {
      const res = await axios.delete("http://localhost/apirest2/?id=" + id);
      getProductos();
      console.log(res)
    }
  };

  const getProducto = async (id) => {
    setBandera(false);
    const res = await axios.get("http://localhost/apirest2/?id=" + id);

    setId(res.data.id);
    setNombre(res.data.nombre);
    setPrecio(res.data.precio);
  };

  const limpiarEstado = () => {
    setId("");
    setNombre("");
    setPrecio("");
    setBandera(true);
  };

  return (
    <div className="container">
      <div className="row">
        <div className="col-md-6 p-2">
          <form className="card p-2 mt-3 border-secondary">
            <h6>React producto</h6>
            <div className="form-group">
              <input
                type="text"
                placeholder="Nomre"
                className="form-control"
                onChange={(e) => setNombre(e.target.value)}
                value={nombre}
              />
            </div>
            <div className="form-group">
              <input
                type="number"
                placeholder="Precio"
                className="form-control"
                onChange={(e) => setPrecio(e.target.value)}
                value={precio}
              />
            </div>
            <button
              className="btn btn-outline-success btn-sm"
              onClick={(e) => addUpdate(e)}
            >
              {bandera ? "Add" : "Edit"}
              <FaCheckCircle />
            </button>
          </form>
        </div>

        <div className="col-md-6 p-2">
          <h5>Listado de productos</h5>
          {lista.map((producto) => (
            <div className="card p-0 mt-1 border-primary" key={producto.id}>
              <div className="card-body tonto">
                <div className="text-primary">
                  {producto.nombre} {producto.precio}
                </div>
                <div className="d-flex flex-row-reverse">
                  <button
                    className="btn btn-outline-danger btn-sm"
                    onClick={() => deleteProducto(producto.id)}
                  >
                    <FaTrash />
                  </button>
                  <button
                    className="btn btn-outline-secondary btn-sm mr-2"
                    onClick={() => getProducto(producto.id)}
                  >
                    <FaPen />
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

export default App;
