@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{asset('admin/assets/css/plugins/quill.core.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/css/plugins/quill.snow.css')}}">

<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card border-0 shadow-none drp-upgrade-card" style="background-image: url({{asset('admin/assets/images/layout/img-profile-card.jpg')}})">
                    <div class="card-body pt--1">
                        <div class="container text-primary mb-3">
                            <h5 class="mb-3 text-center">Website Settings</h5>
                            <form id="settingsForm" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="text-primary">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Site Name</label>
                                            <input type="text" class="form-control form-control-sm" name="site_name" required value="{{ $settings->site_name }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Site Email</label>
                                            <input type="email" class="form-control form-control-sm" name="site_email" required value="{{ $settings->site_email }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Site Mobile</label>
                                            <input type="tel" class="form-control form-control-sm" name="site_mobile" required value="{{ $settings->site_mobile }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Site Address</label>
                                            <input type="text" class="form-control form-control-sm" name="site_address" required value="{{ $settings->site_address }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Admin Auth URL</label>
                                            <input type="text" class="form-control form-control-sm" name="admin_auth_url" required value="{{ $settings->admin_auth_url }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control form-control-sm" name="description" rows="3">{{ $settings->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Keyword</label>
                                            <input type="text" class="form-control form-control-sm" name="keyword" required value="{{ $settings->keyword }}">
                                            <small class="form-text text-muted text-secondary">Separated with comma (eg. davido, wizkid, music)</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 d-none">
                                        <div class="mb-3">
                                            <label class="form-label">Social Links</label>
                                            <input type="text" class="form-control form-control-sm" name="social" required value="{{ $settings->social }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Facebook</label>
                                            <input type="url" class="form-control form-control-sm" name="social_facebook" required value="{{ $settings->social_facebook }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Instagram</label>
                                            <input type="url" class="form-control form-control-sm" name="social_instagram" required value="{{ $settings->social_instagram }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Twitter</label>
                                            <input type="url" class="form-control form-control-sm" name="social_twitter" required value="{{ $settings->social_twitter }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                    	<div class="col-sm-auto mb-3 mb-sm-0">
	                                    	<div class="d-sm-inline-block d-flex align-items-center">
		                                    <img class="wid-60 img-radius mb-2" src="{{ asset('storage/general/'.$settings->socialIcon)}}" alt="logo">
	                                    	</div>
                                    	</div>
                                        <div class="mb-3">
                                            <label class="form-label">Social Icons</label>
                                            <input type="file" class="form-control form-control-sm" name="socialIcon">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    	<div class="col-sm-auto mb-3 mb-sm-0">
	                                    	<div class="d-sm-inline-block d-flex align-items-center">
		                                    <img class="wid-60 img-radius mb-2" src="{{ asset('storage/general/'.$settings->logo)}}" alt="logo">
	                                    	</div>
                                    	</div>
                                        <div class="mb-3">
                                            <label class="form-label">Logo</label>
                                            <input type="file" class="form-control form-control-sm" name="logo">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    	<div class="col-sm-auto mb-3 mb-sm-0">
	                                    	<div class="d-sm-inline-block d-flex align-items-center">
		                                    <img class="wid-60 img-radius mb-2" src="{{ asset('storage/general/'.$settings->footer_logo)}}" alt="logo">
	                                    	</div>
                                    	</div>
                                        <div class="mb-3">
                                            <label class="form-label">Footer Logo</label>
                                            <input type="file" class="form-control form-control-sm" name="footer_logo">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    	<div class="col-sm-auto mb-3 mb-sm-0">
	                                    	<div class="d-sm-inline-block d-flex align-items-center">
		                                    <img class="wid-60 img-radius mb-2" src="{{ asset('storage/general/'.$settings->favicon)}}" alt="logo">
	                                    	</div>
                                    	</div>
                                        <div class="mb-3">
                                            <label class="form-label">Favicon</label>
                                            <input type="file" class="form-control form-control-sm" name="favicon">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tawk Widget ID</label>
                                            <input type="text" class="form-control form-control-sm" name="tawk_widget_id" required value="{{ $settings->tawk_widget_id }}">
                                            <small class="form-text text-muted text-secondary">Create free account on <a href="https://www.tawk.to/">Tawk</a>.</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tawk Property ID</label>
                                            <input type="text" class="form-control form-control-sm" name="tawk_property_id" required value="{{ $settings->tawk_property_id }}">
                                            <small class="form-text text-muted text-secondary">Create free account on <a href="https://www.tawk.to/">Tawk</a>.</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Whatsapp Support</label>
                                            <input type="text" class="form-control form-control-sm" name="whatsapp_support" required value="{{ $settings->whatsapp_support }}">
                                            <small class="form-text text-muted text-secondary">Create whatsapp short link on <a href="https://www.wati.io/free-whatsapp-link-generator/#frm">wati</a>.</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Map Location Embedded Url</label>
                                            <input type="url" class="form-control form-control-sm" name="map_url" required value="{{ $settings->map_url }}">
                                            <small class="form-text text-muted text-secondary">Visit <a href="https://www.google.com/maps">Google Map</a>.</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 d-none">
                                        <div class="mb-3">
                                            <label class="form-label">Email Host</label>
                                            <input type="text" class="form-control form-control-sm" name="email_host" required value="{{ $settings->email_host }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 d-none">
                                        <div class="mb-3">
                                            <label class="form-label">Email Port</label>
                                            <input type="text" class="form-control form-control-sm" name="email_port" required value="{{ $settings->email_port }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 d-none">
                                        <div class="mb-3">
                                            <label class="form-label">Email Username</label>
                                            <input type="text" class="form-control form-control-sm" name="email_username" required value="{{ $settings->email_username }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 d-none">
                                        <div class="mb-3">
                                            <label class="form-label">Email Password</label>
                                            <input type="password" class="form-control form-control-sm" name="email_password" required value="{{ $settings->email_password }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm w-100 text-center">Update</button>
                            </form>
                        </div>
                        
                        <hr class="my-4 border-top border-secondary border-opacity-50 mb-3 mt-3">
                        
                        <div class="container text-primary mt-3">
                        	<h5 class="mb-2 text-center">Core Settings</h5>
	                        <form id="" action="{{ route('admin.settings.updateEnv') }}" method="POST" class="text-primary">
							    @csrf
							    <div class="row">
							        <div class="col-sm-6">
							            <div class="mb-3">
							                <label class="form-label">App Name</label>
							                <input type="text" class="form-control form-control-sm" name="APP_NAME" required value="{{ env('APP_NAME') }}" pattern="[A-Za-z\s]{1,255}" title="App Name should only contain letters and spaces, and be up to 255 characters long.">
							            </div>
							        </div>
							        
							        <div class="col-sm-6">
							            <div class="mb-3">
							                <label class="form-label">App Environment</label>
							                <select class="mb-3 form-select form-select-sm" name="APP_ENV" required>
							                    <option value="local" {{ env('APP_ENV') == 'local' ? 'selected' : '' }}>Testing</option>
							                    <option value="production" {{ env('APP_ENV') == 'production' ? 'selected' : '' }}>Live</option>
							                </select>
							            </div>
							        </div>
							        
							        <div class="col-sm-6">
							            <div class="mb-3">
							                <label class="form-label">App Debug</label>
											<select class="mb-3 form-select form-select-sm" name="APP_DEBUG" required>
											    <option value="true" {{ env('APP_DEBUG') == true ? 'selected' : '' }}>True</option>
											    <option value="false" {{ env('APP_DEBUG') == false ? 'selected' : '' }}>False</option>
											</select>
							            </div>
							        </div>
							        
							        <div class="col-sm-6">
							            <div class="mb-3">
							                <label class="form-label">App URL</label>
							                <input type="url" class="form-control form-control-sm" name="APP_URL" required value="{{ env('APP_URL') }}" pattern="https?://.+" title="Enter a valid URL.">
							            </div>
							        </div>
							        
							        <div class="col-sm-6">
							            <div class="mb-3">
							                <label class="form-label">Mail Host</label>
							                <input type="text" class="form-control form-control-sm" name="MAIL_HOST" required value="{{ env('MAIL_HOST') }}" pattern="^[a-zA-Z0-9._%+-]+\.[a-zA-Z]{2,}$" title="Enter a valid host.">
							            </div>
							        </div>
							        
							        <div class="col-sm-6">
							            <div class="mb-3">
							                <label class="form-label">Mail Port</label>
							                <input type="tel" class="form-control form-control-sm" name="MAIL_PORT" required value="{{ env('MAIL_PORT') }}" pattern="\d+" title="Mail Port should only contain numbers.">
							            </div>
							        </div>
							        
							        <div class="col-sm-6">
							            <div class="mb-3">
							                <label class="form-label">Mail Username</label>
							                <input type="email" class="form-control form-control-sm" name="MAIL_USERNAME" required value="{{ env('MAIL_USERNAME') }}" title="Enter a valid email address.">
							            </div>
							        </div>
							        
							        <div class="col-sm-6">
							            <div class="mb-3">
							                <label class="form-label">Mail Password</label>
							                <input type="password" class="form-control form-control-sm" name="MAIL_PASSWORD" required value="{{ env('MAIL_PASSWORD') }}">
							            </div>
							        </div>
							        
							        <div class="col-sm-6">
							            <div class="mb-3">
							                <label class="form-label">Mail Encryption</label>
							                <input type="text" class="form-control form-control-sm" name="MAIL_ENCRYPTION" required value="{{ env('MAIL_ENCRYPTION') }}" pattern="[A-Za-z]+" title="Mail Encryption should only contain letters.">
							            </div>
							        </div>
							        
							        <div class="col-sm-6">
							            <div class="mb-3">
							                <label class="form-label">Mail From Address</label>
							                <input type="email" class="form-control form-control-sm" name="MAIL_FROM_ADDRESS" required value="{{ env('MAIL_FROM_ADDRESS') }}" title="Enter a valid email address.">
							            </div>
							        </div>
							    </div>
							    <button type="submit" class="btn btn-warning btn-sm w-100">Submit</button>
							</form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('clearButton').addEventListener('click', function() {
        document.getElementById('settingsForm').reset();
    });
</script>
@endsection


