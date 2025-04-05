@extends('website.layouts.master')

@section('title', 'CHECK OUT')

@section('main-content')
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fb;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        max-width: 900px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    label {
        font-size: 16px;
        color: #555;
        margin-bottom: 5px;
    }

    select, input {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        box-sizing: border-box;
    }

    select:focus, input:focus {
        border-color: #28a745;
        outline: none;
    }

    .total-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-container label {
        font-weight: bold;
        font-size: 18px;
    }

    .total-container input {
        font-size: 18px;
        font-weight: bold;
        color: #28a745;
        border: none;
        background: #f4f7fb;
    }

    button {
        padding: 12px 20px;
        font-size: 18px;
        color: #fff;
        background-color: #28a745;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #218838;
    }
</style>

<div class="container">
    <h1>Checkout</h1>

    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <div>
            <label for="subscription_type">Subscription Type:</label>
            <select name="subscription_type" id="subscription_type" required>
                <option value="basic">Basic</option>
                <option value="premium">Premium</option>
                <option value="pro">Elite</option>
            </select>
        </div>

        <div>
            <label for="duration">Duration (in days):</label>
            <input type="number" name="duration" id="duration" value="30" required>
        </div>

        <div class="total-container">
            <label for="total">Total Amount:</label>
            <input type="number" name="total" id="total" value="100" required>
        </div>

        <button type="submit">Go to Checkout</button>
    </form>
</div>

@endsection
