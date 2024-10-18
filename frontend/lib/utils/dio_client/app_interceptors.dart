import 'dart:io';
import 'package:dio/dio.dart';
import 'package:frontend/models/models.dart';
import 'package:frontend/utils/utils.dart';

class AppInterceptors extends Interceptor {
  static AppInterceptors? _singleton;
  final TokenStorage _tokenStorage = TokenStorage(); // For handling the token

  AppInterceptors._internal();

  factory AppInterceptors() {
    return _singleton ??= AppInterceptors._internal();
  }

  @override
  void onRequest(
      RequestOptions options, RequestInterceptorHandler handler) async {
    // Attach Authorization header with token if available
    final token = await _tokenStorage.getToken();
    if (token != null &&
        !options.headers.containsKey(HttpHeaders.authorizationHeader)) {
      options.headers[HttpHeaders.authorizationHeader] = 'Bearer $token';
    } else if (!options.headers.containsKey(HttpHeaders.authorizationHeader)) {
      const fakeToken = "FakeToken";
      options.headers[HttpHeaders.authorizationHeader] = 'Bearer $fakeToken';
    }

    return handler.next(options); // Proceed with the request
  }

  @override
  void onResponse(Response response, ResponseInterceptorHandler handler) {
    // Keep your existing custom response mapping
    final responseData = mapResponseData(
      requestOptions: response.requestOptions,
      response: response,
    );
    return handler.resolve(responseData); // Proceed with the response
  }

  @override
  void onError(DioException err, ErrorInterceptorHandler handler) async {
    // Handle 401 errors (Unauthorized)
    if (err.response?.statusCode == 401) {
      // Handle token expiration or unauthorized errors
      // Optionally refresh token or trigger a logout
      print('401 Unauthorized - Token may have expired');
      // You could add token refresh logic or logout handling here
    }

    // Keep your existing custom error mapping
    final errorMessage = getErrorMessage(err.type, err.response?.statusCode);
    final responseData = mapResponseData(
      requestOptions: err.requestOptions,
      response: err.response,
      customMessage: errorMessage,
      isErrorResponse: true,
    );
    return handler.resolve(responseData); // Proceed with the error response
  }
}

String getErrorMessage(DioExceptionType errorType, int? statusCode) {
  String errorMessage = "";
  switch (errorType) {
    case DioExceptionType.connectionTimeout:
    case DioExceptionType.sendTimeout:
    case DioExceptionType.receiveTimeout:
      errorMessage = DioErrorMessage.deadlineExceededException;
      break;
    case DioExceptionType.badResponse:
      switch (statusCode) {
        case 400:
          errorMessage = DioErrorMessage.badRequestException;
          break;
        case 401:
          errorMessage = DioErrorMessage.unauthorizedException;
          break;
        case 404:
          errorMessage = DioErrorMessage.notFoundException;
          break;
        case 409:
          errorMessage = DioErrorMessage.conflictException;
          break;
        case 500:
          errorMessage = DioErrorMessage.internalServerErrorException;
          break;
      }
      break;
    case DioExceptionType.cancel:
      break;
    case DioExceptionType.unknown:
      errorMessage = DioErrorMessage.unexpectedException;
      break;
    case DioExceptionType.badCertificate:
      break;
    case DioExceptionType.connectionError:
      errorMessage = DioErrorMessage.noInternetConnectionException;
  }
  return errorMessage;
}

Response<dynamic> mapResponseData({
  Response<dynamic>? response,
  required RequestOptions requestOptions,
  String customMessage = "",
  bool isErrorResponse = false,
}) {
  final bool hasResponseData = response?.data != null;

  Map<String, dynamic>? responseData = response?.data;

  if (hasResponseData) {
    responseData!.addAll({
      "statusCode": response?.statusCode,
      "statusMessage": response?.statusMessage
    });
  }

  return Response(
    requestOptions: requestOptions,
    data: hasResponseData
        ? responseData
        : AppResponse(
            message: customMessage,
            success: isErrorResponse ? false : true,
            statusCode: response?.statusCode,
            statusMessage: response?.statusMessage,
          ).toJson(
            (value) => null,
          ),
  );
}

class DioErrorMessage {
  static const badRequestException = "Invalid request";
  static const internalServerErrorException =
      "Unknown error occurred, please try again later.";
  static const conflictException = "Conflict occurred";
  static const unauthorizedException = "Access denied";
  static const notFoundException =
      "The requested information could not be found";
  static const unexpectedException = "Unexpected error occurred.";
  static const noInternetConnectionException =
      "No internet connection detected, please try again.";
  static const deadlineExceededException =
      "The connection has timed out, please try again.";
}
