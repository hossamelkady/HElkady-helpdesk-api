# API examples

Base URL: `http://127.0.0.1:8000/api`

## Create sample record

```http
POST /tickets
Accept: application/json
Content-Type: application/json

{
  "subject": "Cannot export monthly report",
  "requester_email": "maya@example.test",
  "description": "The CSV export stops after loading.",
  "priority": "high",
  "status": "open",
  "assignee": "Support team"
}
```

## Validation

Submit an empty object and the API responds with HTTP 422 and field-level validation errors.
