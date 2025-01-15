const { DataTypes, Model } = require('sequelize');
const sequelize = require('../config/database');

class Alumni extends Model {}

Alumni.init({
  id: { type: DataTypes.INTEGER, primaryKey: true, autoIncrement: true },
  name: { type: DataTypes.STRING, allowNull: false },
  phone: { type: DataTypes.STRING, allowNull: false },
  address: { type: DataTypes.TEXT, allowNull: false },
  graduation_year: { type: DataTypes.INTEGER, allowNull: false },
  status: { type: DataTypes.STRING, allowNull: false },
  company_name: { type: DataTypes.STRING },
  position: { type: DataTypes.STRING },
}, { sequelize, modelName: 'Alumni', tableName: 'alumni', timestamps: false });

module.exports = Alumni;
