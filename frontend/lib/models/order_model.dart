// ignore_for_file: invalid_annotation_target

import 'dart:io';

import 'package:freezed_annotation/freezed_annotation.dart';
part 'order_model.freezed.dart';
part 'order_model.g.dart';

@freezed
class OrderEntity with _$OrderEntity {
  factory OrderEntity({
    required int id,
    @JsonKey(name: 'university') required String universityName,
    @JsonKey(name: 'major') required String majorName,
    @JsonKey(name: 'type') required String orderType,
    @JsonKey(name: 'description') required String orderDescription,
    @JsonKey(name: 'deadline') required String deadline,
    @JsonKey(includeFromJson: false, includeToJson: false) File? file,
  }) = _OrderEntity;

  factory OrderEntity.fromJson(Map<String, dynamic> json) =>
      _$OrderEntityFromJson(json);
}

@freezed
class NewOrder with _$NewOrder {
  factory NewOrder({
    @JsonKey(name: 'created_at') required String orderCreatedAt,
    @JsonKey(name: 'order') required OrderEntity order,
  }) = _NewOrder;

  factory NewOrder.fromJson(Map<String, dynamic> json) =>
      _$NewOrderFromJson(json);
}
