
<?php


class Validation
{
    private $errors;

    public function getErrors(){
        return $this->errors;
    }

    public function validateUser($data)
    {
        $userModel=new UserModel();
        $this->errors = array();
        if (!preg_match('/^[a-zA-Z]*$/', $data['firstName']) || empty($data['firstName'])) {
            $this->errors['first_name'] = "Letters can be in the first name";
        }
        if (!preg_match('/^[a-zA-Z]*$/', $data['lastName']) || empty($data['lastName'])) {
            $this->errors['last_name'] = "Letters can be in the last name";
        }
        if (!(empty($data['password']))) {
            if ($data['password'] != $data['confirmPassword'] || empty($data['password'])) {
                $this->errors['password'] = "The passwords aren't equal";
            }
        }
        if ($userModel->findUserByEmail($data['email'])) {
            $this->errors['email'] = "That email is already in";
        }


        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) || empty($data['email'])) {
            $this->errors['email'] = "Email isn't appropriate";
        }
        $genders = ['female', 'male'];
        if (empty($data['gender']) || !in_array($data['gender'], $genders)) {
            $this->errors['gender'] = "Gender isn't appropriate";
        }
        $roles = ['teacher','pupil'];
        if (empty($data['role']) || !in_array($data['role'], $roles)) {
            $this->errors['role'] = "Role isn't appropriate";
        }
        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }
}
