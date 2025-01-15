const successResponse = (res, message, data, status = 200) => {
    res.status(status).json({ message, data });
  };
  
  const errorResponse = (res, message, status = 500, error = null) => {
    res.status(status).json({ message, error });
  };
  
  module.exports = { successResponse, errorResponse };
  