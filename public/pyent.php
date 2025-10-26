<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookShare - Payment</title>
    <link rel="icon" href="../pics/logo.png" type="image/x-icon" >

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f0ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f0ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://cdn.pixabay.com/vimeo/328940567/payment-24120.mp4?width=1280') center/cover no-repeat;
            filter: blur(5px);
            z-index: -1;
            opacity: 0.15;
        }

        .booking-container {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            width: 100%;
            max-width: 800px;
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .booking-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(31, 38, 135, 0.2);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #213e5e;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .progress-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .step {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 15px;
            background: #e4e6eb;
            color: #65676b;
            transition: all 0.3s ease;
        }

        .step.completed, .step.active {
            background: #213e5e;
            color: white;
            box-shadow: 0 4px 12px rgba(33, 62, 94, 0.3);
        }

        .step-line {
            width: 50px;
            height: 3px;
            background: #e4e6eb;
            border-radius: 2px;
        }

        .step-line.completed {
            background: #213e5e;
        }

        .main-title {
            font-size: 26px;
            color: #1c1e21;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .subtitle {
            color: #65676b;
            font-size: 16px;
        }

        .content {
            padding: 20px 0;
        }

        .booking-summary {
            background: rgba(247, 248, 250, 0.7);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .summary-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #1c1e21;
        }

        .summary-item {
            color: #65676b;
            margin-bottom: 5px;
        }

        .summary-total {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #e4e6eb;
            font-weight: bold;
            color: #1c1e21;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            color: #1c1e21;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #dddfe2;
            border-radius: 8px;
            font-size: 15px;
            background: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #213e5e;
            box-shadow: 0 0 0 3px rgba(41, 100, 178, 0.2);
            background: white;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-pay {
            background: #213e5e;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            flex: 1;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(33, 62, 94, 0.25);
        }

        .btn-pay:hover {
            background: #1a3149;
            box-shadow: 0 6px 16px rgba(33, 62, 94, 0.35);
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #e4e6eb;
            color: #1c1e21;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #d8dadf;
            transform: translateY(-2px);
        }

        .secure-info {
            text-align: center;
            color: #65676b;
            font-size: 13px;
            margin-top: 15px;
        }

        @media (max-width: 768px) {
            .booking-container {
                margin: 10px;
                padding: 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .action-buttons {
                flex-direction: column;
            }
        }

        .loading-spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid #ffffff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
<div class="booking-container">
    <div class="header">
        <div class="logo">Bookshare</div>
        <div class="progress-steps">
            <div class="step completed">1</div>
            <div class="step-line completed"></div>
            <div class="step completed">2</div>
            <div class="step-line completed"></div>
            <div class="step active">3</div>
        </div>
        <h1 class="main-title">Détails de Paiement</h1>
        <p class="subtitle">Finalisez votre réservation en fournissant vos informations de paiement</p>
    </div>
    <div class="content">
        
<form id="paymentForm">
         
<?php
require_once __DIR__ . '/../api/config.php';
?>
            <div class="action-buttons">
                <button type="button" class="btn-cancel" onclick="cancel()">Cancel</button>
                <button type="button" id="payBtn" class="btn-pay" onclick="processPayment()">
                    <span id="loadingSpinner" class="loading-spinner"></span>
                    <span id="payBtnText" href="Booking3.php">Pay Now</span>
                </button>
            </script>
            </div></script>
    <script>
        function cancel() {
            if (confirm('Êtes-vous sûr de vouloir annuler votre réservation de votre Livre ?')) {
                window.location.href = 'index.php';
            }
        }

        window.addEventListener('load', () => {
            document.querySelector('.booking-container').style.opacity = '0';
            document.querySelector('.booking-container').style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                document.querySelector('.booking-container').style.transition = 'all 0.6s ease';
                document.querySelector('.booking-container').style.opacity = '1';
                document.querySelector('.booking-container').style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>

</html>