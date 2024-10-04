class Endpoints {
  /// Current Api Version
  static const _apiVersion = "/api";

  /// Auth
  static const _baseAuth = "$_apiVersion/auth";

  static const register = "$_baseAuth/register";
  static const login = "$_baseAuth/login";
  static const logout = "$_baseAuth/logout";

  /// User

  static const getUsers = "$_apiVersion/user";
}
