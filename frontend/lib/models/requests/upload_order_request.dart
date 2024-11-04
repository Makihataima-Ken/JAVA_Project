// ignore_for_file: invalid_annotation_target

import 'package:freezed_annotation/freezed_annotation.dart';

part 'upload_order_request.freezed.dart';
part 'upload_order_request.g.dart';

@freezed
class UploadOrderRequest with _$UploadOrderRequest {
  factory UploadOrderRequest({
    @JsonKey(name: 'university') required String universityName,
    @JsonKey(name: 'major') required String majorName,
    @JsonKey(name: 'type') required String orderType,
    @JsonKey(name: 'description') required String orderDescription,
    @JsonKey(name: 'deadline') required String deadline,
    @JsonKey(includeFromJson: false, includeToJson: false) String? filePath,
  }) = _UploadOrderRequest;

  factory UploadOrderRequest.fromJson(Map<String, dynamic> json) =>
      _$UploadOrderRequestFromJson(json);
}
