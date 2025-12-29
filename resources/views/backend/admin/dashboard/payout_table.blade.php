<table class="table table-borderless best-selling-courses recent-transactions">
    <thead>
        <tr>
            <th>{{__('organisation_name')}}</th>
            <th>{{__('date')}}</th>
            <th>{{__('amount')}}</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($payouts ?? [] as $payout)
            <tr>
                <td>
                    <div class="instructors-pro d-flex align-items-center">
                        <div class="color-variant-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.0015 14V17.6C15.0015 18.4401 15.0015 18.8601 14.838 19.181C14.6942 19.4632 14.4647 19.6927 14.1825 19.8365C13.8616 20 13.4416 20 12.6015 20H7.40148C6.5614 20 6.14136 20 5.82049 19.8365C5.53825 19.6927 5.30878 19.4632 5.16497 19.181C5.00148 18.8601 5.00148 18.4401 5.00148 17.6V10M19.0015 10V20M5.00148 16H15.0015M5.55925 4.88446L3.58036 8.84223C3.38868 9.22559 3.29284 9.41727 3.31587 9.57308C3.33597 9.70914 3.41122 9.8309 3.52393 9.90973C3.65299 10 3.8673 10 4.29591 10H19.7071C20.1357 10 20.35 10 20.479 9.90973C20.5917 9.8309 20.667 9.70914 20.6871 9.57308C20.7101 9.41727 20.6143 9.22559 20.4226 8.84223L18.4437 4.88446C18.2832 4.5634 18.2029 4.40287 18.0832 4.28558C17.9773 4.18187 17.8496 4.10299 17.7095 4.05465C17.5511 4 17.3716 4 17.0126 4H6.99033C6.63138 4 6.4519 4 6.29344 4.05465C6.15332 4.10299 6.02569 4.18187 5.91979 4.28558C5.80005 4.40287 5.71978 4.5634 5.55925 4.88446Z"
                                    stroke="#3F52E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="inst-intro">
                            <h6>{{ $payout->organization->org_name }}</h6>
                            <p>{{ $payout->organization->country->name }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <span>{{ \Carbon\Carbon::parse($payout->created_at)->format('d F Y') }}</span>
                </td>
                <td><span class="sell">${{ $payout->amount }}</span></td>
            </tr>
        @endforeach
    </tbody>
</table>
