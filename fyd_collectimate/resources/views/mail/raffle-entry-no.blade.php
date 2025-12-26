
<div id="email-template" style="background: #1e1e1e; padding: 30px;">
    <div class="et-wrapper" style="max-width: 720px; margin: 0 auto; padding: 0 15px;">
        <div class="top-section" style="margin-bottom: 30px;display: flex;">
            <div class="floating-img" style="height: 200px;"><img src="https://raffle-entry.botejyu.com.ph/storage/assets/asset-img-1.png" style="height: 100%; width: auto;"></div>
            <div class="logo" style="text-align: center; padding: 15px 0;margin-left: 50px; align-self: center;">
                <a class="logo navbar-btn pull-left" href="https://botejyu.com.ph/" title="Home" rel="home">
                    <img src="https://raffle-entry.botejyu.com.ph/storage/logo/logo.png" alt="Home" style="height: 75px; width: auto; object-fit:contain;">
                </a>
            </div>
        </div>
        <div class="header-section" style="margin-bottom: 30px;display: flex;">
            <div class="image" style="height: 100px;"><img src="https://raffle-entry.botejyu.com.ph/storage/assets/konnichiwa.png" style="height: 100%; width: auto;"></div>
            <div class="details" style="padding-left: 50px;">
                <div class="header" style="font-size: 28px;color: #fad8d6;margin-bottom: 10px;font-weight: 700;">Konnichiwa!</div>
                <div class="header-desc" style="text-align: center;font-size: 22px;color: #fff;margin-bottom: 10px;font-weight: 700;">You've earned {{ count($data) ?? 0 }} raffle {{ (count($data) ?? 0) > 1 ? 'entries' : 'entry' }}. Thank you for joining!</div>
                <div class="announcement-date" style="font-size: 14px;color: #d8d8d8;">Announcement of Winners: November 11, 2025</div>
            </div>
        </div>
        <div class="middle" style="margin-bottom: 50px;">
        @foreach ($data as $datum)
        <div class="entry-ticket" style="background: #000; margin-bottom: 15px; display: flex;">
            <div class="image"><img src="https://raffle-entry.botejyu.com.ph/storage/assets/entry-ticket-img.jpg"></div>
            <div class="details" style="padding: 30px;align-self: center;text-align: center; width: 100%;">
                <div class="title" style="color: #fff; font-size: 24px; margin-bottom: 10px; letter-spacing: 0.5px;">RAFFLE ENTRY CODE:</div>
                <div class="entry-no" style="color: #fff; font-size: 18px; margin-bottom: 10px; letter-spacing: 0.5px;">#{{ $datum->entry_no }}</div>
                <div class="date-earned" style="color: #fff; font-size: 14px; margin-bottom: 10px; letter-spacing: 0.5px;">Date Earned: {{ date('d F, Y', strtotime($datum->receipt_date)) }}</div>
            </div>
        </div>
        @endforeach
        </div>

        <div class="bottom">
            <div class="bottom-wrapper">
                <div class="bot-header" style="font-size: 28px; color: #fad8d6; font-weight: 700; letter-spacing:0.5px; margin-bottom: 30px;">Visit the Botejyu Philippines website to know more about the promo.</div>
                <div class="bot-desc" style="font-size: 14px; color: #fff; margin-bottom: 30px; line-height: 1.7;">Let us know how we can help. If you have specific feedback with your experience at our locations, please email us at
                    <a href="mailto:botejyucustomercare@viva.com.ph" style="color: #fff;">botejyucustomercare@viva.com.ph</a>
                </div>
                <div class="permit" style="font-size: 14px; color: #fff;">DTI Fair Trade Permit No. FTEB - 231489 series of 2025</div>
            </div>
        </div>







    </div>
</div>
