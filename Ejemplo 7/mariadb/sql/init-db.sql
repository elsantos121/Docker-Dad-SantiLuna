USE docker_sample;

CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(250) NOT NULL
);

INSERT INTO usuarios (nombre, email) VALUES
  ('Jose', 'Vue'),
  ('Victor', 'Aparejador'),
  ('Soraya', 'Angular'),
  ('Luis', 'Docker');
