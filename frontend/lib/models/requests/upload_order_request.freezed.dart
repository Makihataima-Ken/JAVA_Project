// coverage:ignore-file
// GENERATED CODE - DO NOT MODIFY BY HAND
// ignore_for_file: type=lint
// ignore_for_file: unused_element, deprecated_member_use, deprecated_member_use_from_same_package, use_function_type_syntax_for_parameters, unnecessary_const, avoid_init_to_null, invalid_override_different_default_values_named, prefer_expression_function_bodies, annotate_overrides, invalid_annotation_target, unnecessary_question_mark

part of 'upload_order_request.dart';

// **************************************************************************
// FreezedGenerator
// **************************************************************************

T _$identity<T>(T value) => value;

final _privateConstructorUsedError = UnsupportedError(
    'It seems like you constructed your class using `MyClass._()`. This constructor is only meant to be used by freezed and you are not supposed to need it nor use it.\nPlease check the documentation here for more information: https://github.com/rrousselGit/freezed#adding-getters-and-methods-to-our-models');

UploadOrderRequest _$UploadOrderRequestFromJson(Map<String, dynamic> json) {
  return _UploadOrderRequest.fromJson(json);
}

/// @nodoc
mixin _$UploadOrderRequest {
  @JsonKey(name: 'university')
  String get universityName => throw _privateConstructorUsedError;
  @JsonKey(name: 'major')
  String get majorName => throw _privateConstructorUsedError;
  @JsonKey(name: 'type')
  String get orderType => throw _privateConstructorUsedError;
  @JsonKey(name: 'description')
  String get orderDescription => throw _privateConstructorUsedError;
  @JsonKey(name: 'deadline')
  String get deadline => throw _privateConstructorUsedError;
  @JsonKey(includeFromJson: false, includeToJson: false)
  String? get filePath => throw _privateConstructorUsedError;

  Map<String, dynamic> toJson() => throw _privateConstructorUsedError;
  @JsonKey(ignore: true)
  $UploadOrderRequestCopyWith<UploadOrderRequest> get copyWith =>
      throw _privateConstructorUsedError;
}

/// @nodoc
abstract class $UploadOrderRequestCopyWith<$Res> {
  factory $UploadOrderRequestCopyWith(
          UploadOrderRequest value, $Res Function(UploadOrderRequest) then) =
      _$UploadOrderRequestCopyWithImpl<$Res, UploadOrderRequest>;
  @useResult
  $Res call(
      {@JsonKey(name: 'university') String universityName,
      @JsonKey(name: 'major') String majorName,
      @JsonKey(name: 'type') String orderType,
      @JsonKey(name: 'description') String orderDescription,
      @JsonKey(name: 'deadline') String deadline,
      @JsonKey(includeFromJson: false, includeToJson: false) String? filePath});
}

/// @nodoc
class _$UploadOrderRequestCopyWithImpl<$Res, $Val extends UploadOrderRequest>
    implements $UploadOrderRequestCopyWith<$Res> {
  _$UploadOrderRequestCopyWithImpl(this._value, this._then);

  // ignore: unused_field
  final $Val _value;
  // ignore: unused_field
  final $Res Function($Val) _then;

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? universityName = null,
    Object? majorName = null,
    Object? orderType = null,
    Object? orderDescription = null,
    Object? deadline = null,
    Object? filePath = freezed,
  }) {
    return _then(_value.copyWith(
      universityName: null == universityName
          ? _value.universityName
          : universityName // ignore: cast_nullable_to_non_nullable
              as String,
      majorName: null == majorName
          ? _value.majorName
          : majorName // ignore: cast_nullable_to_non_nullable
              as String,
      orderType: null == orderType
          ? _value.orderType
          : orderType // ignore: cast_nullable_to_non_nullable
              as String,
      orderDescription: null == orderDescription
          ? _value.orderDescription
          : orderDescription // ignore: cast_nullable_to_non_nullable
              as String,
      deadline: null == deadline
          ? _value.deadline
          : deadline // ignore: cast_nullable_to_non_nullable
              as String,
      filePath: freezed == filePath
          ? _value.filePath
          : filePath // ignore: cast_nullable_to_non_nullable
              as String?,
    ) as $Val);
  }
}

/// @nodoc
abstract class _$$UploadOrderRequestImplCopyWith<$Res>
    implements $UploadOrderRequestCopyWith<$Res> {
  factory _$$UploadOrderRequestImplCopyWith(_$UploadOrderRequestImpl value,
          $Res Function(_$UploadOrderRequestImpl) then) =
      __$$UploadOrderRequestImplCopyWithImpl<$Res>;
  @override
  @useResult
  $Res call(
      {@JsonKey(name: 'university') String universityName,
      @JsonKey(name: 'major') String majorName,
      @JsonKey(name: 'type') String orderType,
      @JsonKey(name: 'description') String orderDescription,
      @JsonKey(name: 'deadline') String deadline,
      @JsonKey(includeFromJson: false, includeToJson: false) String? filePath});
}

/// @nodoc
class __$$UploadOrderRequestImplCopyWithImpl<$Res>
    extends _$UploadOrderRequestCopyWithImpl<$Res, _$UploadOrderRequestImpl>
    implements _$$UploadOrderRequestImplCopyWith<$Res> {
  __$$UploadOrderRequestImplCopyWithImpl(_$UploadOrderRequestImpl _value,
      $Res Function(_$UploadOrderRequestImpl) _then)
      : super(_value, _then);

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? universityName = null,
    Object? majorName = null,
    Object? orderType = null,
    Object? orderDescription = null,
    Object? deadline = null,
    Object? filePath = freezed,
  }) {
    return _then(_$UploadOrderRequestImpl(
      universityName: null == universityName
          ? _value.universityName
          : universityName // ignore: cast_nullable_to_non_nullable
              as String,
      majorName: null == majorName
          ? _value.majorName
          : majorName // ignore: cast_nullable_to_non_nullable
              as String,
      orderType: null == orderType
          ? _value.orderType
          : orderType // ignore: cast_nullable_to_non_nullable
              as String,
      orderDescription: null == orderDescription
          ? _value.orderDescription
          : orderDescription // ignore: cast_nullable_to_non_nullable
              as String,
      deadline: null == deadline
          ? _value.deadline
          : deadline // ignore: cast_nullable_to_non_nullable
              as String,
      filePath: freezed == filePath
          ? _value.filePath
          : filePath // ignore: cast_nullable_to_non_nullable
              as String?,
    ));
  }
}

/// @nodoc
@JsonSerializable()
class _$UploadOrderRequestImpl implements _UploadOrderRequest {
  _$UploadOrderRequestImpl(
      {@JsonKey(name: 'university') required this.universityName,
      @JsonKey(name: 'major') required this.majorName,
      @JsonKey(name: 'type') required this.orderType,
      @JsonKey(name: 'description') required this.orderDescription,
      @JsonKey(name: 'deadline') required this.deadline,
      @JsonKey(includeFromJson: false, includeToJson: false) this.filePath});

  factory _$UploadOrderRequestImpl.fromJson(Map<String, dynamic> json) =>
      _$$UploadOrderRequestImplFromJson(json);

  @override
  @JsonKey(name: 'university')
  final String universityName;
  @override
  @JsonKey(name: 'major')
  final String majorName;
  @override
  @JsonKey(name: 'type')
  final String orderType;
  @override
  @JsonKey(name: 'description')
  final String orderDescription;
  @override
  @JsonKey(name: 'deadline')
  final String deadline;
  @override
  @JsonKey(includeFromJson: false, includeToJson: false)
  final String? filePath;

  @override
  String toString() {
    return 'UploadOrderRequest(universityName: $universityName, majorName: $majorName, orderType: $orderType, orderDescription: $orderDescription, deadline: $deadline, filePath: $filePath)';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType &&
            other is _$UploadOrderRequestImpl &&
            (identical(other.universityName, universityName) ||
                other.universityName == universityName) &&
            (identical(other.majorName, majorName) ||
                other.majorName == majorName) &&
            (identical(other.orderType, orderType) ||
                other.orderType == orderType) &&
            (identical(other.orderDescription, orderDescription) ||
                other.orderDescription == orderDescription) &&
            (identical(other.deadline, deadline) ||
                other.deadline == deadline) &&
            (identical(other.filePath, filePath) ||
                other.filePath == filePath));
  }

  @JsonKey(ignore: true)
  @override
  int get hashCode => Object.hash(runtimeType, universityName, majorName,
      orderType, orderDescription, deadline, filePath);

  @JsonKey(ignore: true)
  @override
  @pragma('vm:prefer-inline')
  _$$UploadOrderRequestImplCopyWith<_$UploadOrderRequestImpl> get copyWith =>
      __$$UploadOrderRequestImplCopyWithImpl<_$UploadOrderRequestImpl>(
          this, _$identity);

  @override
  Map<String, dynamic> toJson() {
    return _$$UploadOrderRequestImplToJson(
      this,
    );
  }
}

abstract class _UploadOrderRequest implements UploadOrderRequest {
  factory _UploadOrderRequest(
      {@JsonKey(name: 'university') required final String universityName,
      @JsonKey(name: 'major') required final String majorName,
      @JsonKey(name: 'type') required final String orderType,
      @JsonKey(name: 'description') required final String orderDescription,
      @JsonKey(name: 'deadline') required final String deadline,
      @JsonKey(includeFromJson: false, includeToJson: false)
      final String? filePath}) = _$UploadOrderRequestImpl;

  factory _UploadOrderRequest.fromJson(Map<String, dynamic> json) =
      _$UploadOrderRequestImpl.fromJson;

  @override
  @JsonKey(name: 'university')
  String get universityName;
  @override
  @JsonKey(name: 'major')
  String get majorName;
  @override
  @JsonKey(name: 'type')
  String get orderType;
  @override
  @JsonKey(name: 'description')
  String get orderDescription;
  @override
  @JsonKey(name: 'deadline')
  String get deadline;
  @override
  @JsonKey(includeFromJson: false, includeToJson: false)
  String? get filePath;
  @override
  @JsonKey(ignore: true)
  _$$UploadOrderRequestImplCopyWith<_$UploadOrderRequestImpl> get copyWith =>
      throw _privateConstructorUsedError;
}
