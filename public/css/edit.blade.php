@extends('layouts.app')

@section('template_title')
	{{ trans('profile.templateTitle') }}
@endsection

@section('content')

	<div class="container">
		
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading tableHeaderBlue">

						<div class="btn-group pull-right btn-group-xs">

							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
								<span class="sr-only">Toggle User Menu</span>
							</button>

							<ul class="dropdown-menu">
								<li class="active">
									<a data-toggle="pill" href=".edit_profile" class="profile-trigger">
										Profile Settings
									</a>
								</li>
								<li>
									<a data-toggle="pill" href=".edit_settings" class="settings-trigger">
										Account Settings
									</a>
								</li>
								<li>
									<a data-toggle="pill" href=".edit_account" class="admin-trigger">
										Account Administration
									</a>
								</li>
							</ul>
						</div>

						<div class="tab-content">
							<span class="tab-pane active edit_profile">
								Comany Branding
								<a data-toggle="pill" style="margin-right: 1em;" href=".edit_settings" class="settings-trigger active float-right" aria-expanded="true">
										Account Settings
									</a>
							</span>
							<span class="tab-pane edit_settings">
								Account Settings
							</span>
							<span class="tab-pane edit_account">
								Account Administration
							</span>
						</div>

					</div>
					<div class="panel-body">
						
						<div class="tab-content">

									<div class="tab-pane fade in active edit_profile">

										<div class="row">
											<div class="col-sm-12">
												<div id="avatar_container">
													<div class="collapseOne panel-collapse collapse ">
														<div class="panel-body">
															<img src="http://growyourleads.com/img/default-user.jpg" alt="elliot robert" class="user-avatar">
														</div>
													</div>
													<div class="collapseTwo panel-collapse collapse  in ">
														<div class="panel-body">

															<div class="dz-preview"></div>

															<form method="POST" action="http://growyourleads.com/avatar/upload" accept-charset="UTF-8" name="avatarDropzone" id="avatarDropzone" class="form single-dropzone dropzone single dz-clickable" enctype="multipart/form-data"><input name="_token" type="hidden" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

																<img id="user_selected_avatar" class="user-avatar" src=" /uploads/users/id/102/avatar/avatar.jpg " alt="elliot robert">

															<div class="dz-default dz-message"><span>Drop files here to upload</span></div></form>

														</div>
													</div>
												</div>
											</div>
										</div>

										<form method="POST" action="http://growyourleads.com/profile/elliot%20robert" accept-charset="UTF-8" class="form-horizontal" role="form" enctype="multipart/form-data"><input name="_method" type="hidden" value="PATCH"><input name="_token" type="hidden" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

											<input type="hidden" name="_token" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

											<div class="row">
												<div class="col-sm-5 col-sm-offset-4 margin-bottom-1">
													<div class="row" data-toggle="buttons">
														<!--<div class="col-xs-6 right-btn-container">
															<label class="btn btn-primary  btn-block btn-sm" data-toggle="collapse" data-target=".collapseOne:not(.in), .collapseTwo.in">
																<input type="radio" name="avatar_status" id="option1" autocomplete="off" value="0" > Use Gravatar
															</label>
														</div>-->
														<div class="col-xs-12 left-btn-container">
															<label class="btn btn-primary  active  btn-block btn-sm" data-toggle="collapse" data-target=".collapseOne.in, .collapseTwo:not(.in)">
																<input type="radio" name="avatar_status" id="option2" autocomplete="off" value="1" checked=""> Use My Image (.Jpg Only)
															</label>
														</div>
													</div>
												</div>
											</div>


											<div class="displayNone form-group has-feedback ">
												<label for="theme" class="col-sm-4 control-label">Your theme:</label>
												<div class="col-sm-6">

													<select class="form-control" name="theme_id" id="theme_id">
																																												  <optt>

													<span class="glyphicon   form-control-feedback" aria-hidden="true"></span>

											        
												</div>
											</div>

											<div class="displayNone form-group has-feedback ">
												<label for="location" class="col-sm-4 control-label">Your location:</label>
												<div class="col-sm-6">
													<input id="location" class="form-control" placeholder="Enter your location" name="location" type="text">
													<span class="glyphicon  glyphicon-pencil  form-control-feedback" aria-hidden="true"></span>
											        												</div>
											</div>

											<div class="displayNone form-group has-feedback ">
												<label for="twitter_username" class="col-sm-4 control-label">Your Twitter username:</label>
												<div class="col-sm-6">
													<input id="twitter_username" class="form-control" placeholder="Enter your Twitter username" name="twitter_username" type="text">
													<span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
											        												</div>
											</div>

											<div class="displayNone margin-bottom-2 form-group has-feedback ">
												<label for="github_username" class="col-sm-4 control-label">Your GitHub username:</label>
												<div class="col-sm-6">
													<input id="github_username" class="form-control" placeholder="Enter your Twitter username" name="github_username" type="text">
													<span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
											        												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-6 col-sm-offset-4">

													<button class="btn btn-success disableddd" type="button" data-target="#confirmForm" data-modalclass="modal-success" data-toggle="modal" data-title="Confirm Save" data-message="Please confirm your changes."><i class="fa fa-fw fa-save" aria-hidden="true"></i> Save Changes</button>

												</div>
											</div>

										</form>

									</div>

									<div class="tab-pane fade edit_settings">

										<form method="POST" action="http://growyourleads.com/profile/102/updateUserAccount" accept-charset="UTF-8" id="user_basics_form"><input name="_method" type="hidden" value="PUT"><input name="_token" type="hidden" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

											<input type="hidden" name="_token" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

								            <div class="form-group has-feedback row ">
								                <label for="name" class="col-md-3 control-label">Full Name</label>
								                <div class="col-md-9">
								                  	<div class="input-group">
								                    	<input id="name" class="form-control" placeholder="Username" name="name" type="text" value="elliot robert">
								                    	<label class="input-group-addon" for="name"><i class="fa fa-fw fa-user }}" aria-hidden="true"></i></label>
								                  	</div>
								                </div>
								            </div>

								            <div class="form-group has-feedback row ">
								                <label for="email" class="col-md-3 control-label">E-mail</label>
								                <div class="col-md-9">
								                  	<div class="input-group">
								                    	<input id="email" class="form-control" placeholder="User Email" name="email" type="text" value="elliotr@gmail.com">
								                    	<label class="input-group-addon" for="email"><i class="fa fa-fw fa-envelope " aria-hidden="true"></i></label>
								                  	</div>
								                </div>
								            </div>

								            <div class="form-group has-feedback row ">
								                <label for="first_name" class="col-md-3 control-label">First Name</label>
								                <div class="col-md-9">
								                  	<div class="input-group">
								                    	<input id="first_name" class="form-control" placeholder="First Name" name="first_name" type="text" value="Elliot">
								                    	<label class="input-group-addon" for="first_name"><i class="fa fa-fw fa-user" aria-hidden="true"></i></label>
								                  	</div>
								                  									                </div>
								            </div>

								            <div class="form-group has-feedback row ">
								                <label for="last_name" class="col-md-3 control-label">Last Name</label>
								                <div class="col-md-9">
								                  	<div class="input-group margin-bottom-1">
								                    	<input id="last_name" class="form-control" placeholder="Last Name" name="last_name" type="text" value="Robert">
								                    	<label class="input-group-addon" for="last_name"><i class="fa fa-fw fa-user" aria-hidden="true"></i></label>
								                  	</div>
								                  									                </div>
								            </div>

								            <div class="form-group has-feedback row ">
								                <label for="company" class="col-md-3 control-label">Company</label>
								                <div class="col-md-9">
								                  	<div class="input-group">
								                    	<div class="input-group">
								                    	<input id="company" class="form-control" placeholder="Company" name="company" type="text" value="Fake Ecommerce Company">
								                    	<label class="input-group-addon" for="company"><i class="fa fa-building-o" aria-hidden="true"></i></label>
								                  	</div>
								                  	</div>
								                  									                </div>
								            </div>

								          	<div class="form-group has-feedback row ">
								                <label for="phone" class="col-md-3 control-label">Phone</label>
								                <div class="col-md-9">
								                  	<div class="input-group">
								                    	<div class="input-group">
								                    	<input id="phone" class="form-control" placeholder="Phone" name="Phone" type="text" value="32828288383838">
								                    	<label class="input-group-addon" for="phone"><i class="fa fa-phone" aria-hidden="true"></i></label>
								                  	</div>
								                  	</div>
								                  									                </div>
								            </div>

										    <div class="form-group row">
											    <div class="col-md-9 col-md-offset-3">
													<button class="btn btn-success" id="account_save_trigger" disabled="" type="button" data-submit="Save Changes" data-target="#confirmForm" data-modalclass="modal-success" data-toggle="modal" data-title="Confirm Save" data-message="Please confirm your changes."><i class="fa fa-fw fa-save" aria-hidden="true"></i> Save Changes</button>
												</div>
											</div>

										</form>

									</div>

									<div class="tab-pane fade edit_account">

										<ul class="nav nav-pills nav-justified margin-bottom-3">
											<li class="bg-info change-pw active">
												<a data-toggle="pill" href="#changepw" class="warning-pill-trigger">
													Change Password
												</a>
											</li>
											<li class="bg-info delete-account">
												<a data-toggle="pill" href="#deleteAccount" class="danger-pill-trigger">
													Delete Account
												</a>
											</li>
										</ul>

										<div class="tab-content">

										    <div id="changepw" class="tab-pane fade in active">

												<h3 class="margin-bottom-1">
													Change Password
												</h3>

												<form method="POST" action="http://growyourleads.com/profile/102/updateUserPassword" accept-charset="UTF-8" autocomplete="new-password"><input name="_method" type="hidden" value="PUT"><input name="_token" type="hidden" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

												    <div class="pw-change-container margin-bottom-2">

														<div class="form-group has-feedback row ">
														  	<label for="password" class="col-md-3 control-label">Password</label>
														  	<div class="col-md-9">
																<div class="hideShowPassword-wrapper" style="position: relative; display: block; vertical-align: baseline; margin: 0px;"><input id="password" class="form-control hideShowPassword-field" placeholder="Password" autocomplete="new-password" name="password" type="password" value="" style="margin: 0px; padding-right: 46px;"><div class="pass-wrapper" style="display: none;"><div class="pass-graybar"><div class="pass-colorbar"></div></div><span class="pass-text"></span></div><button type="button" role="button" aria-label="Show Password" title="Show Password" tabindex="0" class="hideShowPassword-toggle hideShowPassword-toggle-show" aria-pressed="false" style="position: absolute; right: 0px; top: 50%; margin-top: -22px;">Show</button></div>
														        														  	</div>
														</div>

												        <div class="form-group has-feedback row ">
												          	<label for="password_confirmation" class="col-md-3 control-label">Confirm Password</label>
												          	<div class="col-md-9">
												              	<div class="hideShowPassword-wrapper" style="position: relative; display: block; vertical-align: baseline; margin: 0px;"><input id="password_confirmation" class="form-control hideShowPassword-field" placeholder="Confirm Password" name="password_confirmation" type="password" value="" style="margin: 0px; padding-right: 46px;"><button type="button" role="button" aria-label="Show Password" title="Show Password" tabindex="0" class="hideShowPassword-toggle hideShowPassword-toggle-show" aria-pressed="false" style="position: absolute; right: 0px; top: 50%; margin-top: -22px;">Show</button></div>
																<span id="pw_status"></span>
																												          	</div>
												        </div>
												    </div>

												    <div class="form-group row">
													    <div class="col-md-9 col-md-offset-3">
															<button class="btn btn-warning" id="pw_save_trigger" disabled="" type="button" data-submit="Save Changes" data-target="#confirmForm" data-modalclass="modal-warning" data-toggle="modal" data-title="Confirm Save" data-message="Please confirm your changes."><i class="fa fa-fw fa-save" aria-hidden="true"></i> Update Password</button>
														</div>
													</div>
												</form>

	    									</div>

										    <div id="deleteAccount" class="tab-pane fade">

										      	<h3 class="margin-bottom-1 text-center text-danger">
										      		Delete Account
										      	</h3>
										      	<p class="margin-bottom-2 text-center">
													<i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>
														<strong>Deleting</strong> your account is <u><strong>permanent</strong></u> and <u><strong>cannot</strong></u> be undone.
													<i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>
										      	</p>

												<hr>

												<div class="row">
													<div class="col-sm-6 col-sm-offset-3 margin-bottom-3 text-center">

														<form method="POST" action="http://growyourleads.com/profile/102/deleteUserAccount" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

															<div class="btn-group btn-group-vertical margin-bottom-2" data-toggle="buttons">
																<label class="btn no-shadow" for="checkConfirmDelete">
																	<input type="checkbox" name="checkConfirmDelete" id="checkConfirmDelete">
																	<i class="fa fa-square-o fa-fw fa-2x"></i>
																	<i class="fa fa-check-square-o fa-fw fa-2x"></i>
																	<span class="margin-left-2"> Confirm Account Deletion</span>
																</label>
															</div>

														    <button class="btn btn-block btn-danger" id="delete_account_trigger" disabled="" type="button" data-toggle="modal" data-submit="Delete My Account" data-target="#confirmForm" data-modalclass="modal-danger" data-title="Confirm Account Deletion" data-message="Are you sure you want to delete your account?"><i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> Delete My Account</button>

														</form>

													</div>
												</div>
										    </div>
										</div>
									</div>
								</div>

													
					</div>
				</div>
			</div>
		</div>


<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-info">
					<div class="panel-heading">

						<div class="btn-group pull-right btn-group-xs">

							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
								<span class="sr-only">Toggle User Menu</span>
							</button>

							<ul class="dropdown-menu">
								<li class="active">
									<a data-toggle="pill" href=".edit_profile" class="profile-trigger">
										Profile Settings
									</a>
								</li>
								<li>
									<a data-toggle="pill" href=".edit_settings" class="settings-trigger">
										Account Settings
									</a>
								</li>
								<li>
									<a data-toggle="pill" href=".edit_account" class="admin-trigger">
										Account Administration
									</a>
								</li>
							</ul>
						</div>

						<div class="tab-content">
							<span class="tab-pane edit_profile">
								Comany Branding
								<a data-toggle="pill" style="margin-right: 1em;" href=".edit_settings" class="settings-trigger active float-right" aria-expanded="true">
										Account Settings
									</a>
							</span>
							<span class="tab-pane edit_settings active in">
								Account Settings
							</span>
							<span class="tab-pane edit_account">
								Account Administration
							</span>
						</div>

					</div>
					<div class="panel-body">

						
							
								<div class="tab-content">

									<div class="tab-pane fade edit_profile">

										<div class="row">
											<div class="col-sm-12">
												<div id="avatar_container">
													<div class="collapseOne panel-collapse collapse ">
														<div class="panel-body">
															<img src="http://growyourleads.com/img/default-user.jpg" alt="elliot robert" class="user-avatar">
														</div>
													</div>
													<div class="collapseTwo panel-collapse collapse  in ">
														<div class="panel-body">

															<div class="dz-preview"></div>

															<form method="POST" action="http://growyourleads.com/avatar/upload" accept-charset="UTF-8" name="avatarDropzone" id="avatarDropzone" class="form single-dropzone dropzone single dz-clickable" enctype="multipart/form-data"><input name="_token" type="hidden" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

																<img id="user_selected_avatar" class="user-avatar" src=" /uploads/users/id/102/avatar/avatar.png " alt="elliot robert">

															<div class="dz-default dz-message"><span>Drop files here to upload</span></div></form>

														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<form method="POST" action="http://growyourleads.com/profile/elliot%20robert" accept-charset="UTF-8" class="form-horizontal" role="form" enctype="multipart/form-data"><input name="_method" type="hidden" value="PATCH"><input name="_token" type="hidden" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

												<input type="hidden" name="_token" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

												<div class="row">
													<div class="col-sm-5 col-sm-offset-4 margin-bottom-1">
														<div class="row" data-toggle="buttons">
															<!--<div class="col-xs-6 right-btn-container">
																<label class="btn btn-primary  btn-block btn-sm" data-toggle="collapse" data-target=".collapseOne:not(.in), .collapseTwo.in">
																	<input type="radio" name="avatar_status" id="option1" autocomplete="off" value="0" > Use Gravatar
																</label>
															</div>-->
															<div class="col-xs-12 left-btn-container">
																<label class="btn btn-primary  active  btn-block btn-sm" data-toggle="collapse" data-target=".collapseOne.in, .collapseTwo:not(.in)">
																	<input type="radio" name="avatar_status" id="option2" autocomplete="off" value="1" checked=""> Use My Image
																</label>
															</div>
														</div>
													</div>
												</div>


												<div class="displayNone form-group has-feedback ">
													<label for="theme" class="col-sm-4 control-label">Your theme:</label>
													<div class="col-sm-6">

														<select class="form-control" name="theme_id" id="theme_id">
														
														<span class="glyphicon   form-control-feedback" aria-hidden="true"></span>

												        
													</div>
												</div>

												<div class="displayNone form-group has-feedback ">
													<label for="location" class="col-sm-4 control-label">Your location:</label>
													<div class="col-sm-6">
														<input id="location" class="form-control" placeholder="Enter your location" name="location" type="text">
														<span class="glyphicon  glyphicon-pencil  form-control-feedback" aria-hidden="true"></span>
												        												</div>
												</div>

												<div class="displayNone form-group has-feedback ">
													<label for="twitter_username" class="col-sm-4 control-label">Your Twitter username:</label>
													<div class="col-sm-6">
														<input id="twitter_username" class="form-control" placeholder="Enter your Twitter username" name="twitter_username" type="text">
														<span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
												        												</div>
												</div>

												<div class="displayNone margin-bottom-2 form-group has-feedback ">
													<label for="github_username" class="col-sm-4 control-label">Your GitHub username:</label>
													<div class="col-sm-6">
														<input id="github_username" class="form-control" placeholder="Enter your Twitter username" name="github_username" type="text">
														<span class="glyphicon glyphicon-pencil form-control-feedback" aria-hidden="true"></span>
												        												</div>
												</div>

												<div class="form-group">
													<div class="col-sm-6 col-sm-offset-4">

														<button class="btn btn-success disableddd" type="button" data-target="#confirmForm" data-modalclass="modal-success" data-toggle="modal" data-title="Confirm Save" data-message="Please confirm your changes."><i class="fa fa-fw fa-save" aria-hidden="true"></i> Save Changes</button>

													</div>
												</div>

											</form>
										</div><!-- row -->

									</div>

									<div class="tab-pane fade edit_settings active in">

										<form method="POST" action="http://growyourleads.com/profile/102/updateUserAccount" accept-charset="UTF-8" id="user_basics_form"><input name="_method" type="hidden" value="PUT"><input name="_token" type="hidden" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

											<input type="hidden" name="_token" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

								            <div class="form-group has-feedback row ">
								                <label for="name" class="col-md-3 control-label">Full Name</label>
								                <div class="col-md-9">
								                  	<div class="input-group">
								                    	<input id="name" class="form-control" placeholder="Username" name="name" type="text" value="elliot robert">
								                    	<label class="input-group-addon" for="name"><i class="fa fa-fw fa-user }}" aria-hidden="true"></i></label>
								                  	</div>
								                </div>
								            </div>

								            <div class="form-group has-feedback row ">
								                <label for="email" class="col-md-3 control-label">E-mail</label>
								                <div class="col-md-9">
								                  	<div class="input-group">
								                    	<input id="email" class="form-control" placeholder="User Email" name="email" type="text" value="elliotr@gmail.com">
								                    	<label class="input-group-addon" for="email"><i class="fa fa-fw fa-envelope " aria-hidden="true"></i></label>
								                  	</div>
								                </div>
								            </div>

								            <div class="form-group has-feedback row ">
								                <label for="first_name" class="col-md-3 control-label">First Name</label>
								                <div class="col-md-9">
								                  	<div class="input-group">
								                    	<input id="first_name" class="form-control" placeholder="First Name" name="first_name" type="text" value="Elliot">
								                    	<label class="input-group-addon" for="first_name"><i class="fa fa-fw fa-user" aria-hidden="true"></i></label>
								                  	</div>
								                  									                </div>
								            </div>

								            <div class="form-group has-feedback row ">
								                <label for="last_name" class="col-md-3 control-label">Last Name</label>
								                <div class="col-md-9">
								                  	<div class="input-group margin-bottom-1">
								                    	<input id="last_name" class="form-control" placeholder="Last Name" name="last_name" type="text" value="Robert">
								                    	<label class="input-group-addon" for="last_name"><i class="fa fa-fw fa-user" aria-hidden="true"></i></label>
								                  	</div>
								                  									                </div>
								            </div>

								            <div class="form-group has-feedback row ">
								                <label for="company" class="col-md-3 control-label">Company</label>
								                <div class="col-md-9">
								                  	<div class="input-group">
								                    	<div class="input-group">
								                    	<input id="company" class="form-control" placeholder="Company" name="company" type="text" value="Fake Ecommerce Company">
								                    	<label class="input-group-addon" for="company"><i class="fa fa-building-o" aria-hidden="true"></i></label>
								                  	</div>
								                  	</div>
								                  									                </div>
								            </div>

								          	<div class="form-group has-feedback row ">
								                <label for="phone" class="col-md-3 control-label">Phone</label>
								                <div class="col-md-9">
								                  	<div class="input-group">
								                    	<div class="input-group">
								                    	<input id="phone" class="form-control" placeholder="Phone" name="Phone" type="text" value="32828288383838">
								                    	<label class="input-group-addon" for="phone"><i class="fa fa-phone" aria-hidden="true"></i></label>
								                  	</div>
								                  	</div>
								                  									                </div>
								            </div>

										    <div class="form-group row">
											    <div class="col-md-9 col-md-offset-3">
													<button class="btn btn-success" id="account_save_trigger" disabled="" type="button" data-submit="Save Changes" data-target="#confirmForm" data-modalclass="modal-success" data-toggle="modal" data-title="Confirm Save" data-message="Please confirm your changes."><i class="fa fa-fw fa-save" aria-hidden="true"></i> Save Changes</button>
												</div>
											</div>

										</form>

									</div>

									<div class="tab-pane fade edit_account">

										<ul class="nav nav-pills nav-justified margin-bottom-3">
											<li class="bg-info change-pw active">
												<a data-toggle="pill" href="#changepw" class="warning-pill-trigger">
													Change Password
												</a>
											</li>
											<li class="bg-info delete-account">
												<a data-toggle="pill" href="#deleteAccount" class="danger-pill-trigger">
													Delete Account
												</a>
											</li>
										</ul>

										<div class="tab-content">

										    <div id="changepw" class="tab-pane fade in active">

												<h3 class="margin-bottom-1">
													Change Password
												</h3>

												<form method="POST" action="http://growyourleads.com/profile/102/updateUserPassword" accept-charset="UTF-8" autocomplete="new-password"><input name="_method" type="hidden" value="PUT"><input name="_token" type="hidden" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

												    <div class="pw-change-container margin-bottom-2">

														<div class="form-group has-feedback row ">
														  	<label for="password" class="col-md-3 control-label">Password</label>
														  	<div class="col-md-9">
																<div class="hideShowPassword-wrapper" style="position: relative; display: block; vertical-align: baseline; margin: 0px;"><input id="password" class="form-control hideShowPassword-field" placeholder="Password" autocomplete="new-password" name="password" type="password" value="" style="margin: 0px; padding-right: 46px;"><div class="pass-wrapper" style="display: none;"><div class="pass-graybar"><div class="pass-colorbar"></div></div><span class="pass-text"></span></div><button type="button" role="button" aria-label="Show Password" title="Show Password" tabindex="0" class="hideShowPassword-toggle hideShowPassword-toggle-show" aria-pressed="false" style="position: absolute; right: 0px; top: 50%; margin-top: -22px;">Show</button></div>
														        														  	</div>
														</div>

												        <div class="form-group has-feedback row ">
												          	<label for="password_confirmation" class="col-md-3 control-label">Confirm Password</label>
												          	<div class="col-md-9">
												              	<div class="hideShowPassword-wrapper" style="position: relative; display: block; vertical-align: baseline; margin: 0px;"><input id="password_confirmation" class="form-control hideShowPassword-field" placeholder="Confirm Password" name="password_confirmation" type="password" value="" style="margin: 0px; padding-right: 46px;"><button type="button" role="button" aria-label="Show Password" title="Show Password" tabindex="0" class="hideShowPassword-toggle hideShowPassword-toggle-show" aria-pressed="false" style="position: absolute; right: 0px; top: 50%; margin-top: -22px;">Show</button></div>
																<span id="pw_status"></span>
																												          	</div>
												        </div>
												    </div>

												    <div class="form-group row">
													    <div class="col-md-9 col-md-offset-3">
															<button class="btn btn-warning" id="pw_save_trigger" disabled="" type="button" data-submit="Save Changes" data-target="#confirmForm" data-modalclass="modal-warning" data-toggle="modal" data-title="Confirm Save" data-message="Please confirm your changes."><i class="fa fa-fw fa-save" aria-hidden="true"></i> Update Password</button>
														</div>
													</div>
												</form>

	    									</div>

										    <div id="deleteAccount" class="tab-pane fade">

										      	<h3 class="margin-bottom-1 text-center text-danger">
										      		Delete Account
										      	</h3>
										      	<p class="margin-bottom-2 text-center">
													<i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>
														<strong>Deleting</strong> your account is <u><strong>permanent</strong></u> and <u><strong>cannot</strong></u> be undone.
													<i class="fa fa-exclamation-triangle fa-fw" aria-hidden="true"></i>
										      	</p>

												<hr>

												<div class="row">
													<div class="col-sm-6 col-sm-offset-3 margin-bottom-3 text-center">

														<form method="POST" action="http://growyourleads.com/profile/102/deleteUserAccount" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="fLJWuSAWbJbZXqfzBD3wvDbfA1gBDUp4GMlcVDHt">

															<div class="btn-group btn-group-vertical margin-bottom-2" data-toggle="buttons">
																<label class="btn no-shadow" for="checkConfirmDelete">
																	<input type="checkbox" name="checkConfirmDelete" id="checkConfirmDelete">
																	<i class="fa fa-square-o fa-fw fa-2x"></i>
																	<i class="fa fa-check-square-o fa-fw fa-2x"></i>
																	<span class="margin-left-2"> Confirm Account Deletion</span>
																</label>
															</div>

														    <button class="btn btn-block btn-danger" id="delete_account_trigger" disabled="" type="button" data-toggle="modal" data-submit="Delete My Account" data-target="#confirmForm" data-modalclass="modal-danger" data-title="Confirm Account Deletion" data-message="Are you sure you want to delete your account?"><i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> Delete My Account</button>

														</form>

													</div>
												</div>
										    </div>
										</div>
									</div>
								</div>

													
					</div>
				</div>
			</div>
		</div>


	</div>

	@include('modals.modal-form')

@endsection

@section('footer_scripts')

	@include('scripts.form-modal-script')
	@include('scripts.gmaps-address-lookup-api3')
	@include('scripts.user-avatar-dz')

	<script type="text/javascript">

		$('.dropdown-menu li a').click(function() {
			$('.dropdown-menu li').removeClass('active');
		});

		$('.profile-trigger').click(function() {
			$('.panel').alterClass('panel-*', 'panel-default');
		});

		$('.settings-trigger').click(function() {
			$('.panel').alterClass('panel-*', 'panel-info');
		});

		$('.admin-trigger').click(function() {
			$('.panel').alterClass('panel-*', 'panel-warning');
			$('.edit_account .nav-pills li, .edit_account .tab-pane').removeClass('active');
			$('#changepw')
				.addClass('active')
				.addClass('in');
			$('.change-pw').addClass('active');
		});

		$('.warning-pill-trigger').click(function() {
			$('.panel').alterClass('panel-*', 'panel-warning');
		});

		$('.danger-pill-trigger').click(function() {
			$('.panel').alterClass('panel-*', 'panel-danger');
		});

		$('#user_basics_form').on('keyup change', 'input, select, textarea', function(){
		    $('#account_save_trigger').attr('disabled', false);
		});

		$('#checkConfirmDelete').change(function() {
		    var submitDelete = $('#delete_account_trigger');
		    var self = $(this);

		    if (self.is(':checked')) {
		        submitDelete.attr('disabled', false);
		    }
		    else {
		    	submitDelete.attr('disabled', true);
		    }
		});



		$("#password_confirmation").keyup(function() {
			checkPasswordMatch();
		});

		$("#password, #password_confirmation").keyup(function() {
			enableSubmitPWCheck();
		});

		$('#password, #password_confirmation').hidePassword(true);

		$('#password').password({
			shortPass: 'The password is too short',
			badPass: 'Weak - Try combining letters & numbers',
			goodPass: 'Medium - Try using special charecters',
			strongPass: 'Strong password',
			containsUsername: 'The password contains the username',
			enterPass: false,
			showPercent: false,
			showText: true,
			animate: true,
			animateSpeed: 50,
			username: false, // select the username field (selector or jQuery instance) for better password checks
			usernamePartialMatch: true,
			minimumLength: 6
		});
		

		function checkPasswordMatch() {
		    var password = $("#password").val();
		    var confirmPassword = $("#password_confirmation").val();
		    if (password != confirmPassword) {
		        $("#pw_status").html("Passwords do not match!");
		    }
		    else {
		        $("#pw_status").html("Passwords match.");
		    }
		}

		function enableSubmitPWCheck() {
		    var password = $("#password").val();
		    var confirmPassword = $("#password_confirmation").val();
		    var submitChange = $('#pw_save_trigger');
		    if (password != confirmPassword) {
		       	submitChange.attr('disabled', true);
		    }
		    else {
		        submitChange.attr('disabled', false);
		    }
		}

	</script>

@endsection
