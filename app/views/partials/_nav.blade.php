<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    {{ link_to_action('HomeController@getIndex', 'MC_Help', array(),array('class' => 'navbar-brand')) }}
  </div>
  <div class="collapse navbar-collapse navbar-right" id="navbar-collapse">
    <ul class="nav navbar-nav">

      <li>{{ link_to_action('ForumController@getCategoryIndex', 'Forum') }}</li>
      <li>{{ link_to_action('UsersController@getIndex', 'User Database') }}</li>
      <li>{{ link_to_action('HomeController@getSearch', 'Search') }}</li>
      
      @if(!Auth::check())
        <li>{{ link_to_action('UsersController@getUser', 'Signup') }}</li>
        <li>{{ link_to_action('UsersController@getLoginUser', 'Login') }}</li>
      @else
        <li>{{ link_to_action('UsersController@getLogout', 'Logout') }}</li>
      @endif
      
    </ul>
  </div>
</nav>