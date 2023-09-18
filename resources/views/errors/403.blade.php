@extends('errors::minimal')

@section('title', 'Otillåten')
@section('code', '403')
@section('message', $exception->getMessage() ?: 'Otillåten')
