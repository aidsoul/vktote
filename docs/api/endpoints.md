# API Endpoints

Detailed documentation for all available API endpoints.

## Bot Control

### Start Bot

Start the bot for a specific group to fetch and post new entries.

**Endpoint**: `/api/bot.start`

**Method**: `GET`

**Query Parameters**:

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `group` | string | Yes | The group folder name |

**Example Request**:

```
GET /api/bot.start?group=mygroup
```

**Success Response** (200):

```json
{
  "status": "success",
  "message": "Bot started successfully",
  "execution": {
    "time": "0.05 сек.",
    "memory": "2.5 МБ"
  }
}
```

**Error Response** (404):

```json
{
  "status": "error",
  "message": "Group not found",
  "code": 404
}
```

**Error Response** (400):

```json
{
  "status": "error",
  "message": "Group parameter is required",
  "code": 400
}
```

### cURL Example

```bash
curl "https://yourdomain.com/api/bot.start?group=mygroup"
```

### PHP Example

```php
<?php
$client = new GuzzleHttp\Client();
$response = $client->get('https://yourdomain.com/api/bot.start', [
    'query' => ['group' => 'mygroup']
]);
echo $response->getBody();
```

### JavaScript Example

```javascript
async function startBot(groupName) {
    const response = await fetch(`/api/bot.start?group=${groupName}`);
    const data = await response.json();
    console.log(data);
}

startBot('mygroup');
```

## Future Endpoints

The following endpoints are planned for future releases:

### Get Group Status

```http
GET /api/group/status?group=mygroup
```

### List Groups

```http
GET /api/groups
```

### Get Statistics

```http
GET /api/stats?group=mygroup
```

## Error Codes

| Code | Description |
|------|-------------|
| 400 | Bad Request - Missing or invalid parameters |
| 404 | Not Found - Group doesn't exist |
| 500 | Internal Server Error |

## Rate Limiting

Currently, no rate limiting is enforced. However, it's recommended to:
- Space API calls at least 1 minute apart
- Use cron jobs for regular posting
