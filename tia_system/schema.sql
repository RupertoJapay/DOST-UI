-- final schema
CREATE TABLE hr_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE training_entries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  staff_name VARCHAR(255) NOT NULL,
  staff_email VARCHAR(255) NOT NULL,
  staff_type ENUM('COS', 'Permanent') NOT NULL,
  title VARCHAR(255) NOT NULL,
  role VARCHAR(255) NOT NULL,
  start_date DATE NOT NULL,
  end_date DATE NOT NULL,
  hours INT NOT NULL,
  type VARCHAR(255),
  institution VARCHAR(255) NOT NULL,
  unique_code VARCHAR(255) UNIQUE,
  status ENUM('Pending', 'Completed') DEFAULT 'Pending',
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE supporting_docs (
  	id INT AUTO_INCREMENT PRIMARY KEY,
    training_entry_id INT NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (training_entry_id) REFERENCES training_entries(id) ON DELETE CASCADE
);

CREATE TABLE impact_assessments (
	id INT AUTO_INCREMENT PRIMARY KEY,
    training_entry_id INT NOT NULL,
    rating INT NOT NULL,
    comments TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (training_entry_id) REFERENCES training_entries(id) ON DELETE CASCADE
);
