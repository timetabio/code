CREATE TABLE beta_requests (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  created TIMESTAMP NOT NULL DEFAULT utc_now(),
  approved BOOLEAN NOT NULL DEFAULT FALSE,
  email VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE survey_questions (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  title VARCHAR(255),
  weight INTEGER NOT NULL
);

CREATE TABLE survey_answers (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  value INTEGER NOT NULL DEFAULT 0,
  version VARCHAR(255) NOT NULL,
  created TIMESTAMP NOT NULL DEFAULT utc_now(),
  survey_question_id UUID NOT NULL REFERENCES survey_questions (id),
  beta_request_id UUID NOT NULL REFERENCES beta_requests (id)
);

-- TODO: Populate with survey data
INSERT INTO survey_questions (title, weight) VALUES ('I consider myself to be organized', 2);
INSERT INTO survey_questions (title, weight) VALUES ('I am efficient at looking through my documents and information for a lesson / exam', 1);
INSERT INTO survey_questions (title, weight) VALUES ('I often lose my notes / documents', 2);
INSERT INTO survey_questions (title, weight) VALUES ('I often forget to finish things on time', 1);
INSERT INTO survey_questions (title, weight) VALUES ('I often have trouble knowing where my important documents / files are', 2);

ALTER TABLE beta_requests ADD survey_before_completed BOOLEAN NOT NULL DEFAULT FALSE;
