<!-- SENTRY -->
<script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>
<script>Raven.config('{{ config('sentry.public_dsn') }}', {release: '{{ release_id() }}'}).install()</script>
<!-- SENTRY -->
