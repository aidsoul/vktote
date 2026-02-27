# API Overview

VKTote provides a RESTful API for programmatic access to bot functionality.

## Base URL

```
https://yourdomain.com/api/
```

## Authentication

Currently, the API does not require authentication for bot control endpoints. However, you should secure the API endpoints at the web server level if needed.

## Response Format

All API responses are returned in JSON format:

```json
{
  "status": "success",
  "message": "Bot started",
  "data": {}
}
```

## Error Responses

```json
{
  "status": "error",
  "message": "Error description",
  "code": 404
}
```

## Available Endpoints

| Endpoint | Method | Description |
|----------|--------|-------------|
| `/api/bot.start` | GET | Start bot for a group |

For detailed endpoint documentation, see [API Endpoints](endpoints.md).

## Rate Limits

No rate limits are currently enforced. However, be mindful of:
- VK API rate limits
- Telegram API limits

## SDK Examples

### cURL

```bash
curl "https://yourdomain.com/api/bot.start?group=mygroup"
```

### PHP

```php
$client = new GuzzleHttp\Client();
$response = $client->get('https://yourdomain.com/api/bot.start', [
    'query' => ['group' => 'mygroup']
]);
$data = json_decode($response->getBody(), true);
```

### Python

```python
import requests

response = requests.get('https://yourdomain.com/api/bot.start', params={'group': 'mygroup'})
data = response.json()
```

### JavaScript

```javascript
fetch('https://yourdomain.com/api/bot.start?group=mygroup')
  .then(response => response.json())
  .then(data => console.log(data));
```

## Webhooks

Currently, VKTote does not support webhooks. All bot interactions are pull-based via cron jobs or API calls.

## Troubleshooting

### "Group not found"
- Verify the group folder exists
- Check the group name parameter

### "Internal server error"
- Check server logs
- Verify configuration files
