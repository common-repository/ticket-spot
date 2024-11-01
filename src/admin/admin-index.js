import React  from 'react';

const Settings = () => {

  const loginCodeSnippet = `[ticket_spot='REPLACE_WITH_WIDGET_ID']`;

  return (
    <div>
      <h1>Ticket Spot</h1>
      <h2>Setting Ticket Spot is easy as 1-2-3</h2>
      <ol>
        <li>Create a <b><a href='https://app.ticketspot.io' target='_blank'>Ticket Spot</a></b> account</li>
        <li>Add a new wordpress site with a name and url</li>
        <li>Create a new widget and copy the generated shortcode</li>
      </ol>
      <p>
        <video width="600" height="300" controls src="https://cdn.ticketspot.io/ticket-spot-wordpress-intro.mp4">
          <source src="movie.mp4" type="video/mp4" />
          <source src="movie.ogg" type="video/ogg" />
          Your browser does not support the video tag.
        </video>
      </p>
    
      <p class="main">
      <div class="notice notice-info"><p>Once you have created your account and widgets then all event management, ticketing, automation and design can be done within the powerful Ticket Spot platform.</p></div>

				</p>
<div>
      <h2>Shortcode Installation</h2>
      <p>
      <label for="custom_installation">
        <p class="description" id="tagline-description"> Copy &amp; Paste the following shortcode where you want your event widget to appear. Replace <code>REPLACE_WITH_WIDGET_ID</code> with your widget ID from previous steps</p>
        <input type="text" name="custom_installation" id="custom_installation" value={loginCodeSnippet} disabled="disabled" class="regular-text" />
       
        </label>
      </p>
    </div>
    </div>
  );
}

export default Settings;