<?php
ob_start();
?>
<style>
    :root {
        --primary-color: #007bff;
        --primary-hover: #0056b3;
        --text-color: #333333;
        --bg-color: #f4f7f6;
        --card-bg: #ffffff;
        --border-color: #e0e0e0;
        --danger-color: #dc3545;
    }

    div#bpa-content {
        font-family: menu, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--bg-color);
        color: var(--text-color);
        margin: 0;
        padding: 20px;
        display: block;
        justify-content: center;
        align-items: center;
        min-height: 100%;
        height: 100%;
        position: absolute;
        top: 160px;
    }

    .pledge-container {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        max-width: 600px;
        width: 100%;
        padding: 30px;
        border: 1px solid var(--border-color);
    }

    .pledge-header {
        text-align: center;
        margin-bottom: 25px;
        border-bottom: 2px solid var(--bg-color);
        padding-bottom: 15px;
    }

    .pledge-header h2 {
        color: var(--text-color);
        margin: 0;
        font-size: 1.5rem;
    }

    .pledge-header p {
        color: #666;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .pledge-content {
        background-color: #fafafa;
        border-right: 4px solid var(--primary-color);
        padding: 20px;
        border-radius: 4px;
        margin-bottom: 25px;
        line-height: 1.8;
        font-size: 1rem;
        text-align: justify;
    }

    .legal-warning {
        font-size: 0.85rem;
        color: var(--danger-color);
        margin-top: 15px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .checkbox-container {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        cursor: pointer;
        font-size: 0.95rem;
        line-height: 1.5;
        user-select: none;
        margin-bottom: 30px;
    }

    .checkbox-container input {
        margin-top: 4px;
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 12px;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, opacity 0.3s ease;
    }

    .btn-submit:hover {
        background-color: var(--primary-hover);
    }

    #closeBpaBtn {
        width: 20%;
        margin-right: 40%;
    }

    /* حالة الزر عندما يكون معطلاً */
    .btn-submit:disabled {
        background-color: #cccccc;
        color: #666666;
        cursor: not-allowed;
        opacity: 0.7;
    }
</style>

<div class="pledge-container">
    <div class="pledge-header">
        <h2>الإقرار والتعهد القانوني</h2>
        <p>يرجى قراءة التعهد أدناه بعناية والموافقة عليه لاستكمال إرسال البلاغ</p>
    </div>

    <div class="pledge-content">
        أقر أنا مقدِّم البلاغ بأن جميع البيانات والمعلومات الواردة في هذا البلاغ صحيحة ودقيقة وتحت مسؤوليتي الكاملة. كما أتعهد بعدم تقديم أي بلاغ كيدي أو مضلل، وأعلم أن تقديم معلومات غير صحيحة سيعرضني للمساءلة القانونية والملاحقة القضائية وفقًا للأنظمة واللوائح المعمول بها.

        <div class="legal-warning">
            ⚠️ تنبيه: تقديم بلاغات كاذبة يعد مخالفة يعاقب عليها القانون.
        </div>
    </div>

    <label class="checkbox-container">
        <input type="checkbox" id="agreeCheckbox">
        <span>أطلعت على الشروط وأوافق بكامل إرادتي المعتبرة شرعاً وقانوناً على هذا الإقرار والتعهد.</span>
    </label>

    <button type="button" id="closeBpaBtn" class="btn-close" disabled onclick="closeBpaButton()">غلق</button>
</div>
<script>
    $('#bpa-read').on('click', function() {
        // الاستماع لحدث التغيير في مربع الاختيار باستخدام jQuery
        $('#agreeCheckbox').on('change', function() {
            // تفعيل أو تعطيل الزر بناءً على حالة الـ Checkbox
            $('#submitBtn').prop('disabled', !this.checked);
        });

        $('#closeBpaBtn').on('click', function() {
            $('#bpa-content').addClass('hide');
        });


    });
</script>
<?php
return ob_get_clean();
?>