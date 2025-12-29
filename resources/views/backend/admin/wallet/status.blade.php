<p @class([
                                                    'text-success' => $wallet->status == 1,
                                                    'text-danger' => $wallet->status == 2,
                                                    'text-warning' => $wallet->status == 0,
                                                ])>{{ $wallet->status == 1 ? __('approved') :($wallet->status == 2 ? __('rejected') : __('pending')) }}</p>
