@include('console-browser::partials.head')

<div id="console" class="console" data-action="{{ route('console.execute') }}">
	<ul id="response" class="response">
	</ul>

	<nav id="controlbar" class="controlbar">
		<ul id="controls" class="controls">
		</ul>
		<div id="execute" class="execute">@lang("console-browser::console-browser.execute")</div>
	</nav>

	<section id="editor" class="editor"></section>
</div>

@include('console-browser::partials.templates')
@include('console-browser::partials.foot')
