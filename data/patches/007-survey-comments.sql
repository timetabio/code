CREATE TABLE survey_comments (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  body TEXT NOT NULL DEFAULT '',
  beta_request_id UUID NOT NULL REFERENCES beta_requests (id)
);
