import 'package:frontend/models/models.dart';
import 'package:frontend/models/requests/requests.dart';
import "package:frontend/repositories/core/endpoints.dart";
import 'package:frontend/utils/utils.dart';
import 'base_order_repository.dart';
import "package:dio/dio.dart";

class OrderRepository extends BaseOrderRepository {
  OrderRepository({
    Dio? dioClient,
  }) : _dioClient = dioClient ?? DioClient().instance;

  final Dio _dioClient;

  @override
  Future<AppResponse<NewOrder?>> uploadOrder(UploadOrderRequest request) async {
    final response = await _dioClient.post(
      Endpoints.order,
      data: request.toJson(),
    );

    return AppResponse<NewOrder?>.fromJson(
      response.data,
      (dynamic json) {
        if (json != null) {
          return NewOrder(
            orderCreatedAt: json['created_at'],
            order: json['order'],
          );
        }
        return null;
      },
    );
  }
}
